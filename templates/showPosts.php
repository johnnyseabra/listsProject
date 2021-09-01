<div>
    <form action="filterPosts" method="POST">
      <div class="form-group">
        <label for="dateSince">Since</label>
        <input type="date" class="form-control" id="dateSince">
      </div>
      <div class="form-group">
        <label for="dateHence">Hence</label>
        <input type="date" class="form-control" id="dateHence">
      </div>
      <div class="form-group">
        <label for="exampleInputPassword1">Password</label>
        <input type="password" class="form-control" id="exampleInputPassword1">
      </div>
      <div class="form-group form-check">
        <input type="checkbox" class="form-check-input" id="exampleCheck1">
        <label class="form-check-label" for="exampleCheck1">Check me out</label>
      </div>
      <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
<div>
    <table class="table">
      <thead>
        <tr>
          <th scope="col">Date Posted</th>
          <th scope="col">Social Network</th>
          <th scope="col">Link to post</th>
          <th scope="col">Name</th>
          <th scope="col">Lists</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <th scope="row">12/08/2000</th>
          <td>Twitter</td>
          <td>https://linktopost.com/asfdas</td>
          <td>John</td>
          <td>
          	<ul>
          		<li>List 1</li>
          		<li>List 2</li>
          	</ul>
          </td>
        </tr>
      </tbody>
    </table>
</div>
