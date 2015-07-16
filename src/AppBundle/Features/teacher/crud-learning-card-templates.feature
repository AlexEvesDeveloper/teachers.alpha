Feature: create, read, update and delete learning card templates for a classroom
  In order to create learning plans
  As a teacher
  I want to create and manage learning card templates for individual classrooms

  Background:
    Given the database is clean
    And there are the following users:
      | first_name    | last_name  | email            | password  | type    |
      | Nathan        | Bennett    | nathan@test.com  | password  | Teacher |
    And I am logged in as "nathan@test.com"

    Scenario: View a classroom that does not have a learning card template
      Given there are the following classrooms:
        | name                    | teacher     |
        | Basketball Year 7 boys  | Nathan      |
      And the classroom "Basketball Year 7 boys" does not have a template
      When I go to "/classrooms"
      And I follow "Basketball Year 7 boys"
      Then I should see "You have not created a learning template for this classroom, would you like to create one now?"