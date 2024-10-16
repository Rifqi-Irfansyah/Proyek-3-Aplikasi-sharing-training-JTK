@extends('../layoutmaster')

@section('title', 'Approve Trainer')

@section('content')

<!-- Custom Styling -->
<style>
    body {
        background-color: #e9f3fb; /* Light blue background */
    }
    h1 {
        font-weight: bold;
        font-family: 'Arial', sans-serif;
        color: #333;
        text-align: center; /* Center align title */
        margin: 30px 0; /* Margin above and below the title */
    }
    .table {
        width: 90%; /* Set width for the table */
        margin: 0 auto; /* Center align the table */
        border-collapse: collapse; /* Collapse borders */
    }
    .table th {
        background-color: #276BF3; /* Header color */
        color: white; /* Header text color */
        padding: 10px; /* Padding for header */
        font-size: 1.1rem; /* Font size for header */
    }
    .table td {
        background-color: white; /* Cell background color */
        padding: 10px; /* Padding for cells */
        text-align: center; /* Center text in cells */
        border-bottom: 1px solid #ddd; /* Bottom border for rows */
    }
    .table tr:hover {
        background-color: #f1f7fc; /* Change background color on hover */
    }
    .see-detail {
        cursor: pointer; /* Show pointer cursor */
        color: #276BF3; /* Icon color */
    }
    .see-detail:hover {
        text-decoration: underline; /* Underline on hover */
    }
</style>

<!-- Title -->
<div class="container mt-5">
    <h1>Approve Trainer</h1>
</div>

<!-- Main Container -->
<div class="container">
    <table class="table">
        <thead>
            <tr>
                <th>Training Name</th>
                <th>Trainer Name</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>See Detail</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Training Name</td>
                <td>Trainer Name</td>
                <td>DD/MM/YYYY</td>
                <td>DD/MM/YYYY</td>
                <td><span class="see-detail" onclick="location.href='detail-page-url-1'">👁️</span></td>
            </tr>
            <tr>
                <td>Training Name</td>
                <td>Trainer Name</td>
                <td>DD/MM/YYYY</td>
                <td>DD/MM/YYYY</td>
                <td><span class="see-detail" onclick="location.href='detail-page-url-2'">👁️</span></td>
            </tr>
            <tr>
                <td>Training Name</td>
                <td>Trainer Name</td>
                <td>DD/MM/YYYY</td>
                <td>DD/MM/YYYY</td>
                <td><span class="see-detail" onclick="location.href='detail-page-url-3'">👁️</span></td>
            </tr>
            <tr>
                <td>Training Name</td>
                <td>Trainer Name</td>
                <td>DD/MM/YYYY</td>
                <td>DD/MM/YYYY</td>
                <td><span class="see-detail" onclick="location.href='detail-page-url-4'">👁️</span></td>
            </tr>
            <tr>
                <td>Training Name</td>
                <td>Trainer Name</td>
                <td>DD/MM/YYYY</td>
                <td>DD/MM/YYYY</td>
                <td><span class="see-detail" onclick="location.href='detail-page-url-5'">👁️</span></td>
            </tr>
        </tbody>
    </table>
</div>

@endsection
