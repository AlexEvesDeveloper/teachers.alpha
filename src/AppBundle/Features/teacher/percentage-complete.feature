Feature: View the completed percentage of student's activities in my classes
  In order to track the progress of my student's activities
  As a teacher
  I want to view the completed percentage of an activity for any student in my classes

  Background:
    Given the database is clean
    And there are the following users:
      | name        | username  | email             | password  |
      | Teacher     | teacher   | teacher@test.com  | password  |
      | Student     | student   | student@test.com  | password  |
    And I am logged in as a "teacher"

  Scenario: Calculate the completed percentage of a student's activity
    Given I go to "/students/2/basketball"