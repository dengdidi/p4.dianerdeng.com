<center>
<h2><strong>Log in</strong></h2>
<br>

<form method='POST' action='/users/p_login'>

   <h4>Email</h4> 
    <input type='text' name='email'>    
    <br><br>

    <h4>Password</h4>
    <input type='password' name='password'>
    <br><br>

    <?php if(isset($error)): ?>
        <div class="error">
            Login failed. Please double check your email and password.
        </div>
        <br>
    <?php endif; ?>

    <input type='submit' value='Log in'>

</form>
</center>