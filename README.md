# SANDBOX CMS as result of test-task for CV

## TODO List
* Make news/items component.
* Make morphological or AI/ML.
* Make "Observer" pattern for search data indexation and sitemap generation.
* Make 'pseudo' ORM for type constructor.
* Make authorisation and admin level control for restrict content management.
* Create self-sufficient "Menu" component.
* Make comments in code for JSDOC.
* Make tests.

## The task
Deploy a LEMP/LAMP web environment or other web stack on any free VDS/VPS or locally in your virtual environment. This task must be completed on Lavarel or native php (you can use third-party modules via composer if necessary)

## Product Description
Let's implement a news catalog.
The size of the news base is about 100 records.
Records must be generated by a script that will receive record data from any place convenient for you (some kind of parser/generator)
Our catalog will contain 2 types of objects:
<ul>
  <li>News</li>
  <li>Rubric</li>
</ul>

All of those should also be 2 identical forms that allow you to manually add news to the rubric.
The first form does it (sends data) synchronously, and the second asynchronously.

## News
Represents a news object and must contain the following information:
<ul>
  <li>Title</li>
  <li>Announcement</li>
  <li>Text</li>
  <li>May refer to several rubrics (For example, "society", "city day")</li>
</ul>

## Rubric
Headings allow you to classify news items in the catalog.
Rubrics must have a name and can be nested in a tree view.
In a simple case of implementation, the nesting level will be 2-3 rubrics, in a complex case it will be arbitrary.
Here is an example of possible rubrics and their hierarchy:
<ul>
  <li>Society
    <ul>
      <li>City life</li>
      <li>Elections</li>
    </ul>
  </li>
  <li>Day of the city
    <ul>
      <li>Fireworks</li>
      <li>Playground
        <ul>
          <li>0-3 years</li>
          <li>4-7 years</li>
        </ul>
      </li>
    </ul>
  </li>
  <li>Sport</li>
</ul>

## Task
<ol>
    <li>Describe which indexes were used in the database and why.</li>
    <li>If architectural patterns were used, then describe which ones.</li>
    <li>Give us links where you can test the operation of the service, as well as access to the database and source code.</li>
    <li>Using bootstrap, bulma, foundation or any other framework, create a simple adaptive page that will display news and a search bar (full-text search).</li>
    <li>POST request must be used for search (asynchronous).</li>
</ol>

If you have a desire to demonstrate knowledge of a technology or
approach, you can implement arbitrary additional functionality at your discretion.