<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Staff Report View</title>
  @vite('resources/css/staffCss/viewReports.css')
</head>
<body>

  <h1>Incident Reports</h1>

  <table>
    <thead>
      <tr>
        <th>Title</th>
        <th>Date</th>
        <th>Type</th>
        <th>Status</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
        <tr>
          <td></td>
          <td></td>
          <td></td>
          <td>
              <span class="status-Completed">Report Completed</span>
              <span class="status-pending">Report Pending</span>
          </td>
          <td>
            <div class="action-buttons">
              <a href="" class="btn btn-view">View</a>
                <form method="POST" action="">
                  @csrf
                  @method('PATCH')
                  <button type="submit" class="btn btn-action">Mark as Completed</button>
                </form>
            </div>
          </td>
        </tr>

        <tr>
          <td colspan="5">No reports found.</td>
        </tr>
    </tbody>
  </table>

</body>
</html>
