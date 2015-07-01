Feature: Log in as an Administrator
  In order to access the administrator interface
  As a visitor
  I need to be able to log in to the website

  Background:
    Given the database is clean 
    And there are the following users:
      | username  | email       | password  |
      | bar       | bar@foo.com | foo       | 

  Scenario: Log in as admin
    Given I am on homepage
     Then I should not see "Logged in as bar"
     When I follow "Login"
      And I fill in "username" with "bar"
      And I fill in "password" with "foo"
      And I press "security.login.submit"
     Then I should see "Logged in as bar"
     Then I should not see "Login"
     When I follow "Logout"
     Then I should not see "Logged in as bar"
     Then I should see "Login"

  Scenario: Unsuccessful login
    Given I am on homepage
     When I follow "Login"
     When I fill in "username" with "wrong username"
      And I fill in "password" with "wrong password"
      And I press "security.login.submit"
     Then I should see "Bad credentials"

  Scenario: Profile unavailable
    Given I go to "/profile"
     Then the response status code should be 404

  Scenario: Resetting unavailable
    Given I go to "/resetting"
     Then the response status code should be 404
