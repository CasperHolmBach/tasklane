# What is the problem?

Teams need a way to manage their kanban boards digitally. The solution needs to let members be apart of multiple different teams at once. The solution should let people communicate within their different teams using a chat function.


# What is/are the resource(s) used for this topic (for example, Music Albums for the Music Library topic)

The main resource is a Task.
A secondary resource is a Project that contains Tasks.
The standard User resource model from Laravel is used.
A pivot table is needed to connect users assigned to specific projects. This pivot table will be a Team.


# Who are the users

The users are software organizations that need to organize and separate their kanban boards into smaller teams.


# Brief description of what the solution should do (in other words, brief description of use cases, we do not expect more than a few paragraphs)

A user will have an overview of the projects that they are apart of. When inspecting a project they will be shown with the kanban board of that project where all the tasks for that given projet are placed. There will be a chat function for each project that lets team members communicate directly with each other.

# Explain why your solution should be developed using web technologies

## Advantages

By building a web solution, users avoid having to download a native application in order to use my service. Additionally, by running on the web, it automatically becomes system agnostic. This could be benefitial for a software team, where different team members prefer different operating systems.
This would also let team members access the application from their phone with ease.
It is also easier to push new updates to a web app since everything is fetched from a server. This means users won't have to manually keep their app up to date.


## Disadvantages

A web solution requires constant connection to the internet upon use. This is OK, since it is expected when working with live updating / live collaborative work, such as task managing and chatting.
A web solution is less performant than a native application. This is not a dealbreaker since performance won't be critical for a task managing app.