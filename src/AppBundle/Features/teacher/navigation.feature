Feature: Navigate the application as a teacher
  In order to use the application
  As a teacher
  I want to navigate those areas to which I have access

  Background:
    Given the database is clean
    And there are the following users:
      | first_name    | last_name  | email            | password  | type    |
      | Nathan        | Bennett    | nathan@test.com  | password  | Teacher |
      | Alex          | Eves       | alex@test.com    | password  | Student |
      | Ann           | Bennett    | ann@test.com     | password  | Student |
    And I am logged in as "nathan@test.com"

  Scenario: View a list of class
    Given I go to "/classes"
    Then I should see "Your Classes"