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
    And there are the following classrooms:
      | name                    | teacher     |
      | Basketball Year 7 boys  | Nathan      |

    Scenario: View a classroom that does not have a learning card template
      Given the classroom "Basketball Year 7 boys" does not have a template
      When I go to "/classrooms"
      And I follow "Basketball Year 7 boys"
      Then I should see "Create learning card"
      And I should not see "View learning card"

    Scenario: Create a learning card template for a classroom
      Given the classroom "Basketball Year 7 boys" does not have a template
      When I go to "/classrooms"
      And I follow "Basketball Year 7 boys"
      When I follow "Create learning card"
      Then I should see "Basketball Year 7 boys Learning Card"
#      When I press "Add Competency"
#      And I fill in the following:
#        | title                   | minimum | maximum |
#        | Throwing                | 0       | 10      |
#      And I press "Add competency"
#      Then I should see "Throwing"
#      When I press "Back to classroom"
#      Then I should see "View learning card"

      Scenario: View the learning card template for a classroom
        Given the classroom "Basketball Year 7 boys" has an existing template
        When I go to "/classrooms"
        And I follow "Basketball Year 7 boys"
        Then I should see "View learning card"
        And I should not see "Create learning card"
