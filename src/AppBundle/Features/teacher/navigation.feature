Feature: Navigate the application as a teacher
  In order to use the application
  As a teacher
  I want to navigate those areas to which I have access

  Background:
    Given the database is clean
    And there are the following users:
      | name        | username  | email             | password  | type    |
      | Teacher     | Teacher   | teacher@test.com  | password  | Teacher |
      | Alex        | Alex      | student@test.com  | password  | Student |
    And "Student" has a "Basketball" activity
    And all "Basketball" competencies for "Student" have a grade of "0"
    And I am logged in as a "Teacher"

  Scenario: View the completed percentage of a student's activity
    Given I go to "/students/2/basketball"
    Then I should see "Percentage Complete: 0%"