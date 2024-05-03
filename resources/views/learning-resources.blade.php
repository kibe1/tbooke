@include('includes.header')
{{-- Sidebar --}}
@include('includes.sidebar')

{{-- Topbar --}}
<div class="main">
    @include('includes.topbar')
    {{-- Main Content --}}
    <main class="content">
        <div class="container-fluid p-0">
<<<<<<< HEAD
            <h1 class="h3 mb-3">Tbooke Learning Resources</h1>
        </div>
    <style>
        .card {
            border: none;
            transition: transform 0.3s;
        }
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }
        .card-title {
            color: #007bff;
            font-size: 1.0rem;
            margin-bottom: 10px;
        }
        .card-text {
            font-size: 0.8rem;
        }
    </style>
    <section id="core-subjects">
        <h2>Core Academic Subjects</h2>
        <div class="row">
            <div class="col-md-6">
                <div class="card mb-4 bg-info text-white">
                    <div class="card-body">
                        <h5 class="card-title text-white">Language Arts</h5>
                        <p class="card-text">A comprehensive study of language and literature.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card mb-4 bg-primary text-white">
                    <div class="card-body">
                        <h5 class="card-title text-white">Mathematics</h5>
                        <p class="card-text">Exploring the world of numbers, equations, and formulas.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card mb-4 bg-success text-white">
                    <div class="card-body">
                        <h5 class="card-title text-white">Science</h5>
                        <p class="card-text">Investigating the natural world and its phenomena.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card mb-4 bg-warning text-white">
                    <div class="card-body">
                        <h5 class="card-title text-white">Social Studies</h5>
                        <p class="card-text">Understanding society, culture, and history.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="beyond-classroom">
        <h2>Beyond the Classroom</h2>
        <div class="row">
            <div class="col-md-6">
                <div class="card mb-4 bg-secondary text-white">
                    <div class="card-body">
                        <h5 class="card-title text-white">Technology Skills</h5>
                        <p class="card-text">Mastering tools and techniques for the digital age.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card mb-4 bg-dark text-white">
                    <div class="card-body">
                        <h5 class="card-title text-white">Life Skills</h5>
                        <p class="card-text">Developing practical skills for everyday life.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card mb-4 bg-info text-white">
                    <div class="card-body">
                        <h5 class="card-title text-white">Creativity and Self-Expression</h5>
                        <p class="card-text">Exploring creativity and expressing oneself through various mediums.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card mb-4 bg-primary text-white">
                    <div class="card-body">
                        <h5 class="card-title text-white">Foreign Languages</h5>
                        <p class="card-text">Learning languages from around the world.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="additional-opportunities">
        <h2>Additional Learning Opportunities</h2>
        <div class="row">
            <div class="col-md-6">
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title">Test Preparation</h5>
                        <p class="card-text">Preparing for standardized tests and exams.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title">Supplemental Learning</h5>
                        <p class="card-text">Enhancing learning with additional resources and materials.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title">Educational Games and Activities</h5>
                        <p class="card-text">Engaging in interactive games and activities for learning.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title">Learning from Content Creators</h5>
                        <p class="card-text">Exploring educational content created by experts and enthusiasts.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
=======
            <h1 class="h3 mb-3">Coming soon</h1>
        </div>
>>>>>>> fc9eae639b6d911b123dbd9d06ddb096726df666
    </main>
    {{-- footer --}}
    @include('includes.footer')
</div>
