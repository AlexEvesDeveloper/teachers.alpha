Feature: Register a new teacher
  In order to access the application as a teacher
  As a visitor

  Background:
    Given the database is clean

  Scenario: Register a new teacher
    Given I go to "/register/teacher"
    And I fill in "form.email" with "teacher@test.com"
    And I fill in "form.username" with "teacher"
    And I fill in "form.password" with "password"
    And I fill in "form.password_confirmation" with "password"
    And I fill in "Name" with "Teacher"
    And I press "registration.submit"
    Then I should see "registration.confirmed"
    And I should be authenticated as a "teacher"