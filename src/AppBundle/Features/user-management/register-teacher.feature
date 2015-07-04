Feature: Register a new teacher
  In order to access the application as a teacher
  As a visitor

  Background:
    Given the database is clean

  Scenario: Register a new teacher
    Given I go to "/register/teacher"
    And I fill in "Email" with "teacher@test.com"
    And I fill in "Username" with "teacher"
    And I fill in "Password" with "password"
    And I fill in "Repeat password" with "password"
    And I fill in "Name" with "Teacher"
    And I press "Register"
    Then I should see "Congrats teacher, your account is now activated"
    And I should be authenticated as a "teacher"