<div class="container">
    <div class="row">
        <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 mt-5 pt-3 pb-3 bg-white from-wrapper">
            <div class="container">
                <h3>Register</h3>
                <hr>
                <form action="/register" method="post">
                    <div class="row">
                        <div class="col-12 col-sm-6">
                            <div class="form-group">
                                <label for="firstname">Firstname:</label>
                                <input type="text" class="form-control" name="firstname" value="<?= set_value('firstname'); ?>">
                            </div>
                        </div>
                        <div class="col-12 col-sm-6">
                            <div class="form-group">
                                <label for="lastname">Lastname:</label>
                                <input type="text" class="form-control" name="lastname" value="<?= set_value('lastname'); ?>">
                            </div>
                        </div>
                        <div class="col-12 col-sm-12">
                            <div class="form-group">
                                <label for="email">Email:</label>
                                <input type="text" class="form-control" name="email" value="<?= set_value('email'); ?>">
                            </div>
                        </div>
                        <div class="col-12 col-sm-6">
                            <div class="form-group">
                                <label for="password">Password:</label>
                                <input type="password" class="form-control" name="password" value="<?= set_value('password'); ?>">
                            </div>
                        </div>
                        <div class="col-12 col-sm-6">
                            <div class="form-group">
                                <label for="password_confirm">Confirm Password:</label>
                                <input type="password" class="form-control" name="password_confirm" value="">
                            </div>
                        </div>

                        <?php if(isset($validation)){?>
                            <div class="col-12">
                                <div class="alert alert-danger" role="alert">
                                    <?= $validation->listErrors(); ?>
                                </div>
                            </div>
                           
                        <?php }?>
                    </div>
                    <div class="row">
                        <div class="col-12 col-sm-4">
                            <button type="submit" class="btn btn-primary">Register</button>
                        </div>
                        <div class="col-12 col-sm-8 text-right">
                            <a href="/">Already have an account?</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>