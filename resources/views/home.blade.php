<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Database Tutorial</title>
</head>
<body>

    @auth
    <p>
        You are now logged in!. {{ auth()->user()->name }}
    </p>
    <form action="/logout" method="POST">
        @csrf
        <button>Log out</button>
    </form>

    <div style="border: 3px solid black; margin-top: 10px;">
        <h2>Create a New Post</h2>    
        <form action="/create-post" method="POST" style="margin-bottom: 15px;">
            @csrf
            @method('POST')
            <input type="text" name="title" placeholder="Post Title">
            <textarea name="body" placeholder="Body Content..."></textarea>
            <button>Save Post</button>
        </form>
    </div> 

    <div style="border: 3px solid black; margin-top: 10px; margin-bottom: 10px">
        <h2>Send a Message</h2>    
        <form action="/send-message" method="POST" style="margin-bottom: 15px;">
            @csrf
            <input type="text" name="title" placeholder="Title">
            <textarea name="body" placeholder="Type your message..."></textarea>
            <button>Send</button>
        </form>
    </div> 

    <div style="border: 3px solid black;">
        <h2>All Posts</h2>
        @foreach($posts as $post)
        <div style="background-color: gray; padding: 10px; margin: 10px;">
                <h3>
                    {{$post['title']}}
                </h3>    
                {{$post['body']}}
                <p><a href="/edit-post/{{$post->id}}"><button>Edit</button></a></p>
                <form action="/delete-post/{{$post->id}}" method="POST">
                    @csrf
                    @method('DELETE')  
                    <button>Delete</button>
                </form>
            </div>
            @endforeach 
    </div>

    @else
    <div style="border: 3px solid black;">
        <h2 style = "margin-left: 10px">Register</h2>
        <form id="registerForm" action="/register" method="POST" style = "margin-bottom: 15px; padding: 10px;">
            @csrf
            @method('POST')
            <input id="name" name="name" type="text" placeholder="Name">
            <input id="email" name="email" type="text" placeholder="Email">
            <input id="password" name="password" type="password" placeholder="Password">
            <button type="submit">Register</button>
                <p class="alert1" style="color:rgb(255, 0, 0)">
                    Please fill all the requirements.
                </p>
        </form>
    </div>

    <div style="border: 3px solid black; margin-top: 15px;">
        <h2 style = "margin-left: 10px">Log in</h2>
        <form id="loginForm" action="/login" method="POST" style = "margin-bottom: 15px; padding: 10px">
            @csrf
            @method('POST')
            <input id="name1"name="loginname" type="text" placeholder="Name">
            <input id="password1"name="loginpassword" type="password" placeholder="Password">
            <button type="submit">Login</button>
                <p class="alert2" style="padding: 1px solid black; color:rgb(255, 0, 0)">
                    Please fill all the requirements.
                </p>
        </form>
    </div>
    @endauth
    <script>
        const alert1 = document.querySelector(".alert1");
        const alert2 = document.querySelector(".alert2");

        alert1.style.display = "none"
        alert2.style.display = "none"

            // Check if any of the fields in the registration form are empty
            document.getElementById("registerForm").addEventListener("submit", function(e) {
                const name = document.getElementById("name").value.trim();
                const email = document.getElementById("email").value.trim();
                const password = document.getElementById("password").value.trim();
                
                // If any field is empty, prevent form submission and show alert
                if (!name || !email || !password) {
                    e.preventDefault();  // Prevent the form from submitting
                    alert1.style.display = "block";  // Show the alert message
                } else {
                    alert1.style.display = "none";  // Hide the alert if all fields are filled
                }
            });
            // Check if any of the fields in the registration form are empty
            document.getElementById("loginForm").addEventListener("submit", function(e) {
                const name = document.getElementById("name1").value.trim();
                const password = document.getElementById("password1").value.trim();
                
                // If any field is empty, prevent form submission and show alert
                if (!name || !password) {
                    e.preventDefault();  // Prevent the form from submitting
                    alert2.style.display = "block";  // Show the alert message
                } else {
                    alert2.style.display = "none";  // Hide the alert if all fields are filled
                }
            });
    </script>
</body>
</html>