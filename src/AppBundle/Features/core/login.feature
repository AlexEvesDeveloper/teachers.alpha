Feature: Log in to the application
  In order to access the application
  As a visitor
  I need to be able to log in

  Background:
    Given the database is clean
    And there are the following users:
      | name    | username  | email       | password  |
      | Bar     | bar       | bar@foo.com | foo       |

  Scenario: Log in as admin
    Given I am on homepage
     Then I should not see "Logged in as bar"
      When I follow "Login"
      And I fill in "username" with "bar"
      And I fill in "password" with "foo"
      And I press "Login"
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
      And I press "Login"
     Then I should see "Invalid credentials"

  Scenario: Profile unavailable
    Given I go to "/profile"
     Then the response status code should be 404

  Scenario: Resetting unavailable
    Given I go to "/resetting"
     Then the response status code should be 404
