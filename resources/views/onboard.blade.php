<form method="POST" action="{{ route('casuals.onboard') }}">
    @csrf

    <label for="first_name">First Name</label>
    <input type="text" id="first_name" name="first_name" required>

    <label for="last_name">Last Name</label>
    <input type="text" id="last_name" name="last_name" required>

    <label for="id_number">ID/Passport Number</label>
    <input type="text" id="id_number" name="id_number" required>

    <label for="casual_code">Casual Code</label>
    <input type="text" id="casual_code" name="casual_code" required>

    <label for="branch">Branch</label>
    <input type="text" id="branch" name="branch" required>

    <label for="phone_number">Phone Number</label>
    <input type="text" id="phone_number" name="phone_number" required>

    <label for="gender">Gender</label>
    <select id="gender" name="gender" required>
        <option value="male">Male</option>
        <option value="female">Female</option>
    </select>

    <label for="department">Department</label>
    <input type="text" id="department" name="department" required>

    <label for="rate_per_day">Casual Rate per day</label>
    <input type="text" id="rate_per_day" name="rate_per_day" required>

    <button type="submit">Submit</button>
</form>