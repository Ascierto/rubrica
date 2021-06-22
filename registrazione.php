<?php
require __DIR__ . '/includes/header.php';
?>
        <main class="container">
            <div class="row">
                <div class="col-12 col-md-4 offset-md-4">
                    <h1>Registrati</h1>
                </div>
                <div class="col-12 col-md-8 offset-md-2">

                    <form method="POST" action="" class="container">

                    <label for="username" class="form-label">Username</label>
                    <input type="text" name="username" id="username" class="form-control">

                    <label for="password" class="form-label">Password</label>
                    <input type="password" name="password" id="password" class="form-control">

                    <input type="submit" class="btn btn-primary my-3" value="Registrati">

                    </form>            
                </div>
            </div>
        </main>
    </body>
</html>