package health.tropikl.services;

import java.sql.Connection;
import java.sql.SQLException;
import java.time.LocalDate;
import java.time.format.DateTimeFormatter;

import health.tropikl.DAOs.FishbowlDAO;
import health.tropikl.models.requests.DateExistsRequest;
import health.tropikl.models.requests.FishbowlPostRequest;
import health.tropikl.models.results.DateExistsResult;

/**
 * Created by Kavika F.
 */

public class FishbowlService
{
	public static void PostToFishbowl(FishbowlPostRequest fishbowlPostRequest) {
		Connection connection = ConnectionSetup.setup();
		LocalDate dateObj = LocalDate.now();
		DateTimeFormatter formatter = DateTimeFormatter.ofPattern("yyyy-MM-dd");
		String date = dateObj.format(formatter);
		DateExistsRequest dateExistsRequest = new DateExistsRequest(fishbowlPostRequest.getUserID(), date);
		DateExistsResult dateExistsResult = FishbowlDAO.DateExists(connection, dateExistsRequest);
		try {
			if (dateExistsResult.getDateExists()) {
				FishbowlDAO.UpdateTodaysMeal(connection, fishbowlPostRequest);
			}
			else {
				FishbowlDAO.PostNewMeal(connection, fishbowlPostRequest);
			}
		} catch (SQLException e) {
			e.printStackTrace();
		}
	}
}
