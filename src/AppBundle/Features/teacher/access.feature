Feature: Teachers can access specific areas of the application
  In order to use the system correctly
  As a teacher
  I need to be granted and denied access to particular areas of the application

  Background:
    Given the database is clean
    And there are the following users:
      | first_name    | last_name  | email            | password  | type    |
      | Nathan        | Bennett    | nathan@test.com  | password  | Teacher |

  Scenario: Access my classroom list anonymously
    Given I am not logged in
    When I go to "/classrooms"
    Then I should be on "/login"