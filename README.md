# Readme
Docker setup based on project at: https://github.com/denderello/symfony-docker-example

This should be runnable with:
  ```docker-compose up```

This setup includes a Symfony build and includes PHPUnit for unit testing.
Unit tests can be ran with:
  ```docker-compose run symfony composer exec phpunit```

 ## Overview
 This project presents an invoice form that will be submitted.  The submitted data will be used to fill out the template located in the web/ folder of the Symfony project.

Generated PDFs are stored in the web/filled_forms directory and then returned as a binary response.  These files could be stored somewhere associated with a particular user in a larger system if desired.  Otherwise, there would need to be something setup to remove the contents of this folder to prevent storage space from filling up.

## Notes
* Projected was developed on Mac OSX Yosemite using Docker Toolbox
* There is currently nothing in place that would prevent repeated spam of POST requests with supposedly-valid data and possibly eating up storage space.
* The PDF Service currently could be abstracted so that PDFs could be generated based on the page/model used
* It was stated to ignore some fields, but all fields on the PDF were included
* There is no validation on the Address & Comment fields, so these may overrun on the PDF if not filled in appropriately
* ~15 hours was put in for the initial solution (final commit on Nov. 3, 2016)
