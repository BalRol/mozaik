<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your App Name</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Include CSS and JavaScript assets here -->
</head>
<body>
    <header>
        <!-- Your header content goes here -->
    </header>

    <main>
        <h1>Competition List</h1>
            <table id="competitionTable">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Year</th>
                        <th>Location</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Data rows will be inserted here dynamically -->
                </tbody>
            </table>

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
            <script>
                $(document).ready(function() {
                    // Fetch data from the CompetitionController
                    $.ajax({
                        url: '/competitions', // Route to the getCompetition method
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            // Loop through the data and append rows to the table
                            $.each(data, function(index, competition) {
                                $('#competitionTable tbody').append(`
                                    <tr>
                                        <td>${competition.name}</td>
                                        <td>${competition.year}</td>
                                        <td>${competition.location}</td>
                                    </tr>
                                `);
                            });
                        },
                        error: function() {
                            alert('Error fetching competition data.');
                        }
                    });
                });
            </script>
        <h1>Round List</h1>
            <table id="roundTable">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Location</th>
                        <th>Date</th>
                        <th>Competition Name</th>
                        <th>Competition Year</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Data rows will be inserted here dynamically -->
                </tbody>
            </table>

            <script>
                $(document).ready(function() {
                    // Fetch data from the RoundController
                    $.ajax({
                        url: '/rounds', // Route to the index method in RoundController
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            // Loop through the data and append rows to the table
                            $.each(data, function(index, round) {
                                $('#roundTable tbody').append(`
                                    <tr>
                                        <td>${round.id}</td>
                                        <td>${round.name}</td>
                                        <td>${round.location}</td>
                                        <td>${round.date}</td>
                                        <td>${round.competition_name}</td>
                                        <td>${round.competition_year}</td>
                                    </tr>
                                `);
                            });
                        },
                        error: function() {
                            alert('Error fetching round data.');
                        }
                    });
                });
            </script>
        <h1>Competitor List</h1>
            <table id="competitorTable">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Round ID</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Data rows will be inserted here dynamically -->
                </tbody>
            </table>

            <script>
                $(document).ready(function() {
                    // Fetch data from the CompetitorController
                    $.ajax({
                        url: '/competitors', // Route to the index method in CompetitorController
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            // Loop through the data and append rows to the table
                            $.each(data, function(index, competitor) {
                                $('#competitorTable tbody').append(`
                                    <tr>
                                        <td>${competitor.name}</td>
                                        <td>${competitor.email}</td>
                                        <td>${competitor.round_id}</td>
                                    </tr>
                                `);
                            });
                        },
                        error: function() {
                            alert('Error fetching competitor data.');
                        }
                    });
                });
            </script>
        <h1>User List</h1>
            <table id="userTable">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Age</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Data rows will be inserted here dynamically -->
                </tbody>
            </table>

            <script>
                $(document).ready(function() {
                    // Fetch data from the UserController
                    $.ajax({
                        url: '/users', // Route to the index method in UserController
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            // Loop through the data and append rows to the table
                            $.each(data, function(index, user) {
                                $('#userTable tbody').append(`
                                    <tr>
                                        <td>${user.name}</td>
                                        <td>${user.email}</td>
                                        <td>${user.age}</td>
                                    </tr>
                                `);
                            });
                        },
                        error: function() {
                            alert('Error fetching user data.');
                        }
                    });
                });
            </script>
    </main>

    <footer>
        <!-- Your footer content goes here -->
    </footer>
</body>
</html>
