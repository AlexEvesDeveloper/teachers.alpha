Feature: Create, read, update and delete classes as a teacher
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

  Scenario: View a list of classes
    Given I go to "/classes"
    Then I should see "Your Classes"

  Scenario: View a specific class
    Given there are the following classes:
      | name                    | teacher     |
      | Basketball Year 7 boys  | Nathan      |
    When I go to "/classes"
    And I follow "Basketball Year 7 boys"
    Then I should see "Basketball Year 7 boys"