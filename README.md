It is necessary to build a class architecture and abstraction of interaction with the database, file system, cache and log
and implement daily distribution of the workday plan to all employees in txt format

Everything must be built on abstraction,
to implement, you don’t just need to write comments on what functionality should be described,

We have a table with employees,
folder with a plan for each day of the week
(there should be only 5 files, we simply check the file creation date and determine whether it is a new plan or not, if not, we throw an exception)

at 9:00 from Mon - Fri we send out the plan to employees

cache
cache users
(since we have a large database of employees, we take them from the cache, for clarity, perhaps we will have a different repository, api, etc.)

log
In the log table, record the employee’s name, path to the report file, the date the report was generated and the time it was sent - code only, without a database

log and cache must be implemented by separate classes that will be used in the class we need

post the code on GitHub or, if possible, on Packagist