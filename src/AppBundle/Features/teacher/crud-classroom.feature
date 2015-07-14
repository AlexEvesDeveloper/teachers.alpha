Feature: Create, read, update and delete my classrooms
  In order to use the application
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

  Scenario: View a list of classrooms
    Given there are the following classrooms:
      | name                    | teacher     |
      | Basketball Year 7 boys  | Nathan      |
      | Netball Year 7 girls    | Laura       |
    And I go to "/classrooms"
    Then I should see "Your Classrooms"
    And I should see "Basketball Year 7 boys"
    And I should not see "Netball Year 7 girls"

  Scenario: View a specific classroom
    Given there are the following classrooms:
      | name                    | teacher     |
      | Basketball Year 7 boys  | Nathan      |
    And the classrooms have the following students:
      | classroom               | student_first_name  | student_second_name |
      | Basketball Year 7 boys  | Alex                | Eves                |
      | Netball Year 7 girls    | Ann                 | Bennett             |
    When I go to "/classrooms"
    And I follow "Basketball Year 7 boys"
    Then I should see "Basketball Year 7 boys"
    And I should see "Alex Eves"
    And I should not see "Ann Bennett"

  Scenario: Create a new classroom
    Given there are the following classrooms:
      | name                    | teacher     |
      | Basketball Year 7 boys  | Nathan      |
    When I go to "/classrooms"
    And I follow "Create new classroom"
    And I fill in the following:
      | Title | Football Year 8 boys |
    And I press "Create"
    And I go to "/classrooms"
    Then I should see "Football Year 8 boys"