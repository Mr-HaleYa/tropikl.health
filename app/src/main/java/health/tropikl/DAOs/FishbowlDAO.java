package health.tropikl.DAOs;

import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.util.ArrayList;
import java.util.List;

import androidx.annotation.NonNull;
import health.tropikl.models.requests.DateExistsRequest;
import health.tropikl.models.requests.FishbowlPostRequest;
import health.tropikl.models.results.DateExistsResult;

/**
 * Created by Kavika F.
 */

public class FishbowlDAO
{
	public static DateExistsResult DateExists(Connection connection, DateExistsRequest dateExistsRequest) {
		DateExistsResult result;
		try {
			String sql = "SELECT id FROM data WHERE user_id=?,date=?";
			PreparedStatement statement = connection.prepareStatement(sql);
			statement.setInt(1, dateExistsRequest.getUserID());
			statement.setString(2, dateExistsRequest.getDate());
			ResultSet rs = statement.executeQuery();
			if (rs.next()) {
				result = new DateExistsResult(true);
			}
			else {
				result = new DateExistsResult(false);
			}
		} catch (SQLException e) {
			result = new DateExistsResult(false);
		}
		return result;
	}

	public static void PostNewMeal(@NonNull Connection connection, @NonNull FishbowlPostRequest fishbowlPostRequest) throws SQLException {
		String sql = "INSERT INTO data (\"user_id\",";
		List<String> colorStrings = new ArrayList<>();
		fishbowlPostRequest.getColors().forEach((color) -> colorStrings.add("\"" + color + "\""));
		String columns = String.join(",", colorStrings);
		sql += columns;
		sql += ") VALUES ";
		List<String> questionMarks = new ArrayList<>();
		fishbowlPostRequest.getColors().forEach((color) -> questionMarks.add("?"));
		String querySection = "(" + String.join(",",questionMarks) + ")";
		sql += querySection;

		PreparedStatement statement = connection.prepareStatement(sql);
		for (int i = 1; i < fishbowlPostRequest.getColors().size()+1; i++) {
			statement.setInt(i, 1);
		}
		statement.executeQuery();
	}

	public static void UpdateTodaysMeal(Connection connection, FishbowlPostRequest fishbowlPostRequest) throws SQLException {
		String sql = "UPDATE data SET ";
		List<String> colorStrings = new ArrayList<>();
		fishbowlPostRequest.getColors().forEach((color) -> colorStrings.add(color + "=?"));
		String columns = String.join(",", colorStrings);
		sql += columns;
		sql += " WHERE user_id=?";
		PreparedStatement statement = connection.prepareStatement(sql);
		for (int i = 1; i < colorStrings.size()+1; i++) {
			statement.setInt(i, 1);
		}
		statement.setInt(colorStrings.size()+1, fishbowlPostRequest.getUserID());
		statement.executeUpdate();
	}
}
