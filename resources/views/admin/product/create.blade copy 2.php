<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Select2 with Bootstrap & Search</title>

    <!-- jQuery (Must be included before Select2) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Select2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet">

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Select2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>

    <style>
        .select2-container .select2-selection--multiple {
            border: 1px solid #ced4da !important;
            border-radius: 5px !important;
            padding: 5px;
            min-height: 38px !important;
        }

        .select2-container--default .select2-selection--multiple .select2-selection__choice {
            background-color: #007bff !important;
            color: white !important;
            border-radius: 3px !important;
            padding: 5px;
            margin: 2px;
        }

        .select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
            color: white !important;
            margin-right: 5px;
        }
    </style>
</head>
<body>

    <div class="container mt-4">
        <label for="category" class="form-label">Select Categories</label>
        <select id="category" name="categories[]" class="form-control select2" multiple="multiple">
            <option value="1">Technology</option>
            <option value="2">Business</option>
            <option value="3">Health</option>
            <option value="4">Education</option>
            <option value="5">Finance</option>
            <option value="6">Science</option>
            <option value="7">Marketing</option>
            <option value="8">Design</option>
        </select>
    </div>
    
    <script>
        $(document).ready(function() {
            $('#category').select2({
                placeholder: "Search and select categories", // Placeholder text
                allowClear: true, // Enable clear button
                width: '100%' // Ensure full width
            });
        });
    </script>

</body>
</html>
