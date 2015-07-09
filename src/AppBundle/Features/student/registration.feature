#Feature: Register a new student
#  In order to access the application as a student
#  As a visitor
#  I want to register a new student account
#
#  Background:
#    Given the database is clean
#
#  Scenario: Register a new student
#    Given I go to "/register/student"
#    When I fill in the following:
#      | Email           | student@test.com  |
#      | Username        | student           |
#      | Password        | password          |
#      | Repeat password | password          |
#      | Name            | Student           |
#    And I press "Register"
#    Then I should see "Congrats student, your account is now activated"
#    And I should be authenticated as a "student"