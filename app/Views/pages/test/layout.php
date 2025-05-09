<?= $this->extend('layouts/default') ?>

<?= $this->section('content') ?>
<div class="page-header breadcrumb-wrap">
    <div class="container">
        <div class="breadcrumb">
            <a href="<?= base_url() ?>" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
            <span></span> <a href="<?= base_url('test') ?>">Test</a> <span></span> Layout Test
        </div>
    </div>
</div>
<div class="page-content pt-50">
    <div class="container">
        <div class="row">
            <div class="col-xl-10 col-lg-12 m-auto">
                <section class="mb-50">
                    <h1 class="mb-4">Layout Test</h1>
                    
                    <div class="card mb-4">
                        <div class="card-header">
                            <h5>Typography</h5>
                        </div>
                        <div class="card-body">
                            <h1>Heading 1</h1>
                            <h2>Heading 2</h2>
                            <h3>Heading 3</h3>
                            <h4>Heading 4</h4>
                            <h5>Heading 5</h5>
                            <h6>Heading 6</h6>
                            <p>This is a paragraph with <a href="#">link</a>, <strong>bold text</strong>, and <em>italic text</em>.</p>
                            <blockquote>This is a blockquote.</blockquote>
                        </div>
                    </div>
                    
                    <div class="card mb-4">
                        <div class="card-header">
                            <h5>Buttons</h5>
                        </div>
                        <div class="card-body">
                            <button class="btn">Default Button</button>
                            <button class="btn btn-small">Small Button</button>
                            <button class="btn btn-xs">Extra Small Button</button>
                            <button class="btn btn-heading btn-shadow-brand hover-up">Shadow Button</button>
                            <hr>
                            <button class="btn btn-fill-out">Fill Out Button</button>
                            <button class="btn btn-brand">Brand Button</button>
                            <button class="btn btn-default">Default Style</button>
                            <hr>
                            <button class="btn hover-up"><i class="fi-rs-arrow-small-right"></i>Icon Button</button>
                        </div>
                    </div>
                    
                    <div class="card mb-4">
                        <div class="card-header">
                            <h5>Form Elements</h5>
                        </div>
                        <div class="card-body">
                            <form>
                                <div class="mb-3">
                                    <label class="form-label">Text Input</label>
                                    <input type="text" class="form-control" placeholder="Text input">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Email Input</label>
                                    <input type="email" class="form-control" placeholder="Email input">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Password Input</label>
                                    <input type="password" class="form-control" placeholder="Password input">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Select</label>
                                    <select class="form-select">
                                        <option>Option 1</option>
                                        <option>Option 2</option>
                                        <option>Option 3</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Checkbox</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="check1">
                                        <label class="form-check-label" for="check1">Checkbox 1</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="check2">
                                        <label class="form-check-label" for="check2">Checkbox 2</label>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Radio</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="radio" id="radio1">
                                        <label class="form-check-label" for="radio1">Radio 1</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="radio" id="radio2">
                                        <label class="form-check-label" for="radio2">Radio 2</label>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Textarea</label>
                                    <textarea class="form-control" rows="3"></textarea>
                                </div>
                                <button type="submit" class="btn btn-fill-out">Submit</button>
                            </form>
                        </div>
                    </div>
                    
                    <div class="card mb-4">
                        <div class="card-header">
                            <h5>Grid System</h5>
                        </div>
                        <div class="card-body">
                            <div class="row mb-3">
                                <div class="col-sm-12 bg-light p-2">col-sm-12</div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-6 bg-light p-2">col-sm-6</div>
                                <div class="col-sm-6 bg-light p-2">col-sm-6</div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-4 bg-light p-2">col-sm-4</div>
                                <div class="col-sm-4 bg-light p-2">col-sm-4</div>
                                <div class="col-sm-4 bg-light p-2">col-sm-4</div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-3 bg-light p-2">col-sm-3</div>
                                <div class="col-sm-3 bg-light p-2">col-sm-3</div>
                                <div class="col-sm-3 bg-light p-2">col-sm-3</div>
                                <div class="col-sm-3 bg-light p-2">col-sm-3</div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="card mb-4">
                        <div class="card-header">
                            <h5>Alerts</h5>
                        </div>
                        <div class="card-body">
                            <div class="alert alert-success" role="alert">
                                This is a success alert!
                            </div>
                            <div class="alert alert-info" role="alert">
                                This is an info alert!
                            </div>
                            <div class="alert alert-warning" role="alert">
                                This is a warning alert!
                            </div>
                            <div class="alert alert-danger" role="alert">
                                This is a danger alert!
                            </div>
                        </div>
                    </div>
                    
                    <a href="<?= base_url('test') ?>" class="btn btn-fill-out">Back to Tests</a>
                </section>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?> 