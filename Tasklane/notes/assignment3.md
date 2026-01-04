# Security & CRUD Operations

## Why is it important to restrict actions in the first place?
By restricting peoples actions, we can have control over what people are able to see and manipulate. This is benifitial so that users that don't know what they are doing, don't accidentally mess with any logic og the database. Additionally, we prevent users who do know what they are doing, from gaining uncontrolled access to resources they shouldn't be allowed to access.

## How do you hide restricted actions from even appearing on the website?
I wrap the html elements that need to be hidden with @auth @else and @endauth tags. @auth is the functionality that requires auth to be shown while @else is what is shown if the user isn’t logged in. E.g. i can make sure that an already logged in user doesn't still see the "login" button on the landing page. This is only for UX and is not a security measure itself.

## How do you ensure smart users cannot send requests to restricted actions?
I have created middleware for the different routes that check whether or not the user is authorized or not. This middleware runs before each request and ensures that smart users can't directly access for example the dashboard route by simply guessing the url.

## How do you validate (i.e., test) that you are restricting actions?
I can be done by manually testing while being logged in or logged in. 
However, it can also be automated using "Dusk". Dusk is used for creating browser tests that can could be used for the exact case of testing different restricted actions.


# Perfomance, Scalability & Greenability

## How can you validate the performance of the application? In other words, what steps must you take to ensure the application is ready according to its needs? (e.g., if you have an e-commerce site, a typical day vs black Friday)
I can test it with the 3 types of tests. Unit tests, integration tests and end-to-end tests. The difference between these types of tests is simply how big of a chunk of the system, the test tests. These tests will be used to ensure that the core functionality of the system works as intended.

To handle spikes / black friday scenarios, i could simulate a lot of users accessing popular or critical parts of my webapplication through a stress test. This way i can easily identify if and how my webapplicaiton breaks down. This makes it easy to identify main bottlenecks of the system.

## When do you need to scale your application? If necessary, how would you consider scaling your application for your specific use case? Is there any configuration you should change? (hint: where are you storing sessions?)
When the webapplication can no longer keep up with the average traffic that the rising amount of consumers are producing. The smartest move is almost always to scale horizontally, since there is a physical limit on scaling vertically. Scaling horizontally when building a session based webapplication can be tricky though. For this a distributed session system would be appropriate. Here user sessions will be stored in a separate, fast, storage solution like redis, and all servers will fetch a users session from there. The best solution would be to make my webapplication fully stateless, which would make horizontal scaling very easy. This would require more code refactoring though.


## How does performance relate to greenability? What changes would you make to your application (code, configuration, deployment, etc) to ensure it is running green?
- Code effeciency and system performance has a big impact on greenability for software. Ineffecient code forces the CPU to run in a high-power state for longer amounts of time. Network I/O traffic utilizes real hardware for communication. The more traffic, the more energy is consumed. Disk I/O is also an energy intensive task. Excessive database reads will lead to excessive energy consumption.
- One way I can do this is by caching efficiently. Caching allows for temporarily saving often used values that are requested by the user. This way other users who request the same resource can fetch it directly from the cache instead of going through the whole request process. This saves resources and also gives the user quicker response times.


# REST

## Why is your current application not RESTful?
Right now the server / backend stores sessions about users that log in. This makes the application stateful, which violates RESTful application design.

## What changes do you need to apply to make it RESTful?
In order for my webapplication to be RESTful, it would need to be stateless. Right now im authenticating using session-based authentication. This should be replaced with something like token-based authentication (like JWT). Using this model, the server does not store any session state but instead the client sends this token with every request and gets validated by the server. This would make my webapplication a breeze to scale horizontally, since my application would become fully stateless

## Considering that we use sessions to store authenticated users, how RESTful applications impact this feature? Is it even possible to have authenticated users? Why?
Yes this is possible. It can be done either through a distributed session system as mentioned, or through sticky sessions. When using sticky sessions, the horizontally scaled servers are still stateful and therefore it becomes a load balancers duty to redirect users to the same server every time.