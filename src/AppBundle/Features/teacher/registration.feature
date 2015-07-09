#Feature: Register a new teacher
#  In order to access the application as a teacher
#  As a visitor
#  I want to register a new teacher account
#
#  Background:
#    Given the database is clean
#
#  Scenario: Register a new teacher
#    Given I go to "/register/teacher"
#    When I fill in the following:
#      | Email           | teacher@test.com  |
#      | Username        | teacher           |
#      | Password        | password          |
#      | Repeat password | password          |
#      | Name            | Teacher           |
#    And I press "Register"
#    Then I should see "Congrats teacher, your account is now activated"
#    And I should be authenticated as a "teacher"