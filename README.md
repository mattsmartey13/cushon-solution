# [Cushon solution](https://github.com/mattsmartey13/cushon-solution)

## Contents
[The problem](#the-problem)

[First assumptions](#first-assumptions)

[ERD](#erd)

[Scenarios // Use cases](#scenarios)

[Why I chose this solution](#why-i-chose-this-solution)

[Future improvements](#future-improvements)

## The problem

Cushon already offers ISAs and Pensions to Employees of Companies (Employers) who have an existing arrangement with Cushon. 
Cushon would like to be able to offer ISA investments to retail (direct) customers who are not associated with an employer. 
Cushon would like to keep the functionality for retail ISA customers separate from it’s Employer based offering where practical.

When customers invest into a Cushon ISA they should be able to select a single fund from a list of available options. 
Currently they will be restricted to selecting a single fund however in the future we would anticipate allowing selection of multiple options.

Once the customer’s selection has been made, they should also be able to provide details of the amount they would like to invest.

Given the customer has both made their selection and provided the amount the system should record these values and allow these details to be queried at a later date. 
As a specific use case please consider a customer who wishes to deposit £25,000 into a Cushon ISA all into the Cushon Equities Fund.

## First assumptions
### Technical
- Retail and employer based ISA's to differ
  - Construct this as a microservice, as the employer based solution already exists
  - Database tables not built as part of proposal, but could vary from the existing retail service
  - Therefore, no crossover with this service in terms of functionality or accounts

### Business logic
- Transactions in GBP but we should be able to add more down the line
- One ISA with a list of investment funds, list currently restricted to one fund
  - Deposit refers to the money transferred to the ISA account, but an investment refers to the particular fund of the ISA
  - One account : one or many investment relationship should be planned for when designing the system
- Cannot start an account without an investment
- Cannot start an investment without a fund selected
- Not fixed term ISAs
- Cannot change the investment fund
- User is only permitted one investment ISA
- User hasn't exceeded the £20,000 ISA limit for the tax year, in that case offer to reject the deposit fully or deposit an amount equal to or under their remaining limit for the tax year

## Top level view of the solution
- Retail investment microservice
- Start off with investment ISA's, but should be built to allow other types of ISA a retail customer may want (cash, lifetime)
- Rest of the Cushon architecture eg. authorization, report generation, emailing etc. handled elsewhere // out of scope
- Using Symfony 6
  - Experience with Symfony commercially 
  - Doctrine ORM easy to use
  - Annotations for defining entities, routes etc. - Symfony style is aesthetically pleasing (IMO)
- Sufficient experience to write this in Python (Flask) but as the role entails PHP knowledge I decided to stay on topic

## ERD
![ERD](/Cushon%20ERD.png)

## Scenarios
### Account creation use case
```gherkin
  Feature: Customer opening an ISA account.

  Background:
    Given that I am an authenticated user with a customer account
    When making requests via a RESTful API

  Scenario: Customer wants to open an investment ISA account and does not have another investment ISA for this tax year.
    Given I am opening an ISA account
     When I POST "/customer/{customerId}/account/create"
      And I set the body payload to
      """
      {
        "type": "STOCK_SHARES_ISA",
        "unique": true
      }
      """
     Then I should get a status code of 201
      And I should see a success message 
    
  Scenario: Customer wants to open an investment ISA account but already has another investment ISA for this tax year.
    Given I am opening an ISA account
     When I request POST "/customer/{customerId}/account/create"
      And I set JSON payload to
      """
      {
        "type": "STOCK_SHARES_ISA",
        "unique": false
      }
      """
    Then I should get a status code of 201
    And I should see an error message
```

### Deposit use case
```gherkin
Feature: Customer wishes to make deposits into their investment ISA account
  
Background:
  Given that I am an authenticated user with a customer account
  And I have a valid investment account
  When making requests via a RESTful API
  
Scenario: Customer wants to deposit an amount equal to or below their yearly ISA limit
  Given I am investing into my Investment ISA account
  When I POST "/customer/{id}/account/{id}/investment/{id}/deposit"
  And I set the body to
  """
  {
    'fundId': '25dg352h-6hg7-e40z-5889-gkh4b9g2h351'
    'amount': 2000000
    'currency': 'GBP'
  }
  """
  Then we should see a status code of 201, 
  And be shown with a success message

  Scenario: Customer wants to deposit an amount above their yearly ISA limit
    Given I am investing into my Investment ISA account
    When I POST "/customer/{id}/account/{id}/investment/{id}/deposit"
    And I set the body to
  """
  {
    'fundId': '25dg352h-6hg7-e40z-5889-gkh4b9g2h351'
    'amount': 3000000
    'currency': 'GBP'
  }
  """
    Then we should see a status code of 422,
    And be shown an error message explaining why the request failed

  Scenario: Customer is below their limit but their next investment will take them above their limit
    Given I am investing into my Investment ISA account
    And I have invested £18,000 in the fund this year
    And I wish to invest £3,000 in this transaction
    When I POST "/customer/{id}/account/{id}/investment/{id}/deposit"
    And I set the body to
  """
  {
    'amount': 300000
    'currency': 'GBP'
  }
  """
    Then we should see a status code of 422,
    And be shown an error message explaining why the request failed
```

### Account history use case
```gherkin
Feature: Customer wishes to view their investment(s)
  
Background:
  Given that I am an authenticated user with a customer account
  And I have a valid retail account
  And I have a valid investment account
  When making requests via a RESTful API
  
Scenario: Customer wants to see their investments for all their investment funds
  Given I am investing into my Investment ISA account
  When I GET "/customer/{customerId}/account/{accountId}/investment"
  Then we should see a status code of 200
  And I should see my investments
  And they should list the total amount of funds invested in each
  
Scenario: Customer wants to see a singular investment of theirs
  Given I am investing into my Investment ISA account
  When I GET "/customer/{customerID}/account/{accountId}/investment/{investmentId}"
  Then we should see a status code of 200
  And I should see the investment I was after
```

## Why I chose this solution
- IMO the entity layout describes my understanding of the problem and is an accurate representation of the business based on my limited knowledge
- Enums were useful in defining currency and account types characteristics
- Fakes to test the repositories and entities rather than mocking them

## Future improvements
- Once code base gets more complicated, move a lot of the "legwork" controller code to a service that becomes a dependency of the controller
- Translation interface with values for each language stored in a seperate yaml file, for international users
  - Then again not sure if this would be handled by the service receiving responses from this one
- Implement ability to manage multiple investments as a portfolio
- More detailed domain objects upon further understanding of the business
- Throw more specific exceptions rather than generic Exception in the example controller
- Interest rates and currency exchange should be stored in a database - a more persistant method to store and update the values as these change frequently
- With more knowledge of the business I could have used some more sophisticated design patterns
