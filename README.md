# Enterprise Application Development Project

		
## Overview
This was a project done during my 4th year of my Computer Science course.

It involved creating a RESTful server application that handled requests via a number of uri

Written in PHP, it uses a MVC architecture based on the [Slim Framework](https://www.slimframework.com/). Data is retrieved from a populated MySQL Database and represents college students and assignments. Data is returned in JSON format.

### API Examples
*? represents a variable value*

- *Return all students in database*
-- `http://antohayden.com/ead/statistics/students`
-- [Example](http://antohayden.com/ead/statistics/students)

- *Return student by their id*
-- `http://antohayden.com/ead/statistics/students/?`
-- [Example](http://antohayden.com/ead/statistics/students/2c458829fb4835cec11b0b8069ea6030a62a6eb2)

- *Return all students of a specific nationality*
-- `http://antohayden.com/ead/statistics/students/nationality/?`
-- [Example](http://antohayden.com/ead/statistics/students/nationality/Ireland)

- *Return all tasks assigned*
-- `http://antohayden.com/ead/statistics/tasks`
-- [Example](http://antohayden.com/ead/statistics/tasks)

- *Return all courses*
-- `http://antohayden.com/ead/statistics/course`
-- [Example](http://antohayden.com/ead/statistics/course)

- *Return all tasks for a course id*
-- `http://antohayden.com/ead/statistics/tasks/course/?`
-- [Example](http://antohayden.com/ead/statistics/tasks/course/4)

- *Return all questionnaires*
-- `http://antohayden.com/ead/statistics/questionnaires`
-- [Example](http://antohayden.com/ead/statistics/questionnaires)

- *Return all questionnaires answered by a student*
-- `http://antohayden.com/ead/statistics/questionnaires/student/?`
-- [Example](http://antohayden.com/ead/statistics/questionnaires/student/5103998213d65435ff532cda5aff9fcc34862d13)
