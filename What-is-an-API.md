# What is an API?

API stands for Application Programming Interface.

Application - website, project, a server - it's an app!
Programming - refers to the act of giving instructions to a computer program
Interface - the set of inputs that allow you (or something else) to interact with a computer / server


An imaginary set of buttons that (something) can press to make a computer program do something.

Examples:
- https://developer.spotify.com/documentation/web-api/
- https://developers.google.com/maps

Both of the above examples are "imaginary buttons" that Spotify/Google provide so that anyone can use the data they have and the functionality of their applications, without having a user do those things.

For example, the Spotify API provides and imaginary button that allows you to create new playlists, search for songs, etc.

Typically in the web world, the "buttons" are API endpoints that you send HTTP requests to - when you send a GET, POST, PUT/PATCH, or DELETE request to those endpoints, the matching action is typically taken.

GET: get a bunch of data (multiple records or one record)
POST: create data
PUT / PATCH: updating data
DELETE: delete data

For example, if we want to get a list of songs from Spotify's API, we would make a GET request (from our application) to Spotify's server, and Spotify's server would give us data back.

On the web, the data format that APIs typically use is JSON (JavaScript Object Notation) - both for recieving data, and for returning data to a user of that API.