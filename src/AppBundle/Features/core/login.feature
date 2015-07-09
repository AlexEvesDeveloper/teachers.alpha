Feature: Log in to the application
  In order to access the application
  As a visitor
  I need to be able to log in

  Background:
    Given the database is clean
    And there are the following users:
      | first_name    | last_name  | email          | password  | type    |
      | Alex          | Eves       | alex@test.com  | password  | Teacher |

  Scenario: Log in as admin
    Given I am on homepage
     Then I should not see "Logged in as bar"
     When I follow "Login"
      And I fill in "Email" with "alex@test.com"
      And I fill in "Password" with "password"
      And I press "Login"
     Then I should see "Logged in as Alex Eves"
     Then I should not see "Login"
     When I follow "Logout"
     Then I should not see "Logged in as Alex Eves"
     Then I should see "Login"

  Scenario: Unsuccessful login
    Given I am on homepage
     When I follow "Login"
     When I fill in "Email" with "wrong username"
      And I fill in "Password" with "wrong password"
      And I press "Login"
     Then I should see "Invalid credentials"

  Scenario: Profile unavailable
    Given I go to "/profile"
     Then the response status code should be 404

  Scenario: Resetting unavailable
    Given I go to "/resetting"
     Then the response status code should be 404
