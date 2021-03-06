Feature: View the completed percentage of student's activities in my classes
  In order to track the progress of my student's activities
  As a teacher
  I want to view the completed percentage of an activity for any student in my classes

  Background:
    Given the database is clean
    And there are the following users:
      | first_name    | last_name  | email            | password  | type    |
      | Nathan        | Bennett    | nathan@test.com  | password  | Teacher |
      | Alex          | Eves       | alex@test.com    | password  | Student |
    And "Student" has a "Basketball" activity
    And all "Basketball" competencies for "Student" have a grade of "0"
    And I am logged in as "Teacher"


#  Scenario: View the completed percentage of a student's activity
#    Given I go to "/students/2/basketball"
#    Then I should see "Percentage Complete: 0%"
