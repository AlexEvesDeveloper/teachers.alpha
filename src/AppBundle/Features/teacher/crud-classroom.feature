Feature: Create, read, update and delete my classrooms
  In order create learning plans
  As a teacher
  I want to create and manage my own classrooms

  Background:
    Given the database is clean
    And there are the following users:
      | first_name    | last_name  | email            | password  | type    |
      | Nathan        | Bennett    | nathan@test.com  | password  | Teacher |
      | Laura         | Bennett    | laura@test.com   | password  | Teacher |
      | Alex          | Eves       | alex@test.com    | password  | Student |
      | Ann           | Bennett    | ann@test.com     | password  | Student |
    And I am logged in as "nathan@test.com"

  Scenario: Create a new classroom
    Given I go to "/classrooms"
    When I follow "Create new classroom"
    And I fill in the following:
      | Name | Football Year 7 boys |
    And I press "Create classroom"
    Then I should see "Football Year 7 boys"

  Scenario: View a list of classrooms
    Given there are the following classrooms:
      | name                    | teacher     |
      | Basketball Year 7 boys  | Nathan      |
      | Football Year 7 boys    | Nathan      |
      | Netball Year 7 girls    | Laura       |
    When I go to "/classrooms"
    Then I should see "Your Classrooms"
    And I should see "Basketball Year 7 boys"
    And I should see "Football Year 7 boys"
    And I should not see "Netball Year 7 girls"

  Scenario: View a specific classroom
    Given there are the following classrooms:
      | name                    | teacher     |
      | Basketball Year 7 boys  | Nathan      |
      | Football Year 7 boys    | Nathan      |
    When I go to "/classrooms"
    And I follow "Basketball Year 7 boys"
    Then I should see "Basketball Year 7 boys"
    And I should not see "Football Year 7 boys"

  Scenario: Delete a classroom
    Given there are the following classrooms:
      | name                    | teacher     |
      | Football Year 7 boys    | Nathan      |
      | Netball Year 7 girls    | Nathan      |
    When I go to "/classrooms"
    And I follow "Football Year 7 boys"
    When I follow "Delete this classroom"
    Then I should be on "/classrooms"
    And I should not see "Football Year 7 boys"
    And I should see "Netball Year 7 girls"