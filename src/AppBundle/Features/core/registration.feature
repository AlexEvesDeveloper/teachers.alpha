Feature: Register a new student
  In order to access the application as a student
  As a visitor
  I want to register a new student account

  Background:
    Given the database is clean

  Scenario: Register a new teacher
    Given I go to "/register/teacher"
    When I fill in the following:
      | First name      | Nathan            |
      | Last name       | Bennett           |
      | Email           | nathan@test.com   |
      | Password        | password          |
      | Repeat password | password          |
    And I press "Register"
    Then I should see "Congrats Nathan, your account is now activated."
    And I should be authenticated as a "teacher"

  Scenario: Register a new student
    Given I go to "/register/student"
    When I fill in the following:
      | First name      | Alex              |
      | Last name       | Eves              |
      | Email           | alex@test.com     |
      | Password        | password          |
      | Repeat password | password          |
    And I press "Register"
    Then I should see "Congrats Alex, your account is now activated"
    And I should be authenticated as a "student"

