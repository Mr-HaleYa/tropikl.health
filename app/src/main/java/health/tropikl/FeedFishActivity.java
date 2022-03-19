package health.tropikl;

import androidx.appcompat.app.AppCompatActivity;
import health.tropikl.models.requests.FishbowlPostRequest;
import health.tropikl.services.FishbowlService;

import android.annotation.SuppressLint;
import android.content.Intent;
import android.os.Bundle;
import android.view.DragEvent;
import android.view.MotionEvent;
import android.view.View;
import android.view.View.OnDragListener;
import android.view.View.OnTouchListener;
import android.view.View.DragShadowBuilder;
import android.view.Window;
import android.view.WindowManager;
import android.widget.Button;
import android.widget.FrameLayout;
import android.widget.ImageView;
import android.widget.TextView;

import java.util.ArrayList;
import java.util.List;
import java.util.Objects;

public class FeedFishActivity extends AppCompatActivity implements OnTouchListener, OnDragListener
{
	List<String> colors = new ArrayList<>();
	Button mClearButton;
	boolean wasShown;
	int idValue;
	final static String IDIntent = "ID INTENT";
	@SuppressLint("ClickableViewAccessibility")
	@Override
	protected void onCreate(Bundle savedInstanceState)
	{
		super.onCreate(savedInstanceState);
		Intent mIntent = getIntent();
		idValue = mIntent.getIntExtra(IDIntent, 0);
		requestWindowFeature(Window.FEATURE_NO_TITLE);
		this.getWindow().setFlags(WindowManager.LayoutParams.FLAG_FULLSCREEN, WindowManager.LayoutParams.FLAG_FULLSCREEN);
		Objects.requireNonNull(getSupportActionBar()).hide();
		setContentView(R.layout.activity_feed_fish);

		ImageView circleRed = findViewById(R.id.circleRed);
		ImageView circleOrange = findViewById(R.id.circleOrange);
		ImageView circleYellow = findViewById(R.id.circleYellow);
		ImageView circleGreen = findViewById(R.id.circleGreen);
		ImageView circleBluPur = findViewById(R.id.circleBluPur);
		ImageView circleBrown = findViewById(R.id.circleBrown);

		circleRed.setOnTouchListener(this);
		circleOrange.setOnTouchListener(this);
		circleYellow.setOnTouchListener(this);
		circleGreen.setOnTouchListener(this);
		circleBluPur.setOnTouchListener(this);
		circleBrown.setOnTouchListener(this);

		circleRed.setOnDragListener(this);
		circleOrange.setOnDragListener(this);
		circleYellow.setOnDragListener(this);
		circleGreen.setOnDragListener(this);
		circleBluPur.setOnDragListener(this);
		circleBrown.setOnDragListener(this);
		findViewById(R.id.bucketImage).setOnDragListener(this);

		List<ImageView> imageViews = new ArrayList<>();
		imageViews.add(circleRed);
		imageViews.add(circleOrange);
		imageViews.add(circleYellow);
		imageViews.add(circleRed);
		imageViews.add(circleGreen);
		imageViews.add(circleBluPur);
		imageViews.add(circleBrown);

		Button mSubmitButton = findViewById(R.id.SubmitMealButton);
		mSubmitButton.setOnClickListener(view -> {
			FishbowlPostRequest fishbowlPostRequest = new FishbowlPostRequest(idValue, colors);
			FishbowlService.PostToFishbowl(fishbowlPostRequest);
		});

		mClearButton = findViewById(R.id.ClearBucketButton);
		mClearButton.setOnClickListener(view -> {
			if (colors.size() > 0) {
				colors.clear();
				for (ImageView imageView : imageViews) {
					imageView.setVisibility(View.VISIBLE);
				}
				mClearButton.setEnabled(false);
			}
		});
	}

	@SuppressLint("NonConstantResourceId")
	@Override
	public boolean onTouch(View v, MotionEvent e) {
		v.performClick();
		int viewID = v.getId();
		FrameLayout mTextFrameLayout = findViewById(R.id.FoodTextFrame);
		TextView mFoodDescription = findViewById(R.id.ColorTextDescription);
		int colorID = 0;
		int textID = 0;
		switch(viewID) {
			case R.id.circleRed:
				colorID = getResources().getColor(R.color.red, getTheme());
				textID = R.string.DescRedFood;
				break;
			case R.id.circleOrange:
				colorID = getResources().getColor(R.color.orange, getTheme());
				textID = R.string.DescOrangeFood;
				break;
			case R.id.circleYellow:
				colorID = getResources().getColor(R.color.yellow, getTheme());
				textID = R.string.DescYellowFood;
				break;
			case R.id.circleGreen:
				colorID = getResources().getColor(R.color.green, getTheme());
				textID = R.string.DescGreenFood;
				break;
			case R.id.circleBluPur:
				colorID = getResources().getColor(R.color.blue, getTheme());
				textID = R.string.DescBluPurFood;
				break;
			case R.id.circleBrown:
				colorID = getResources().getColor(R.color.brown, getTheme());
				textID = R.string.DescBrownFood;
				break;
			default:
				System.out.println("SELECTING COLOR IS BROKEN");
				break;
		}
		mTextFrameLayout.setBackgroundColor(colorID);
		mFoodDescription.setText(textID);
		DragShadowBuilder shadowBuilder = new DragShadowBuilder(v);
		v.setVisibility(View.INVISIBLE);
		wasShown = false;
		v.startDragAndDrop(null, shadowBuilder, v, 0);
		return true;
	}

	@SuppressLint("NonConstantResourceId")
	@Override
	public boolean onDrag(View v, DragEvent e) {
		if (!wasShown) {
			switch(e.getAction()) {
				case DragEvent.ACTION_DRAG_STARTED:
					System.out.println("STARTED");
					return true;
				case DragEvent.ACTION_DRAG_ENTERED:
					System.out.println("ENTERED");
					return true;
				case DragEvent.ACTION_DRAG_LOCATION:
					// Ignore the event.
					return true;
				case DragEvent.ACTION_DRAG_EXITED:
					System.out.println("EXITED");
					return true;
				case DragEvent.ACTION_DROP:
					System.out.println("DROP");
					return true;
				case DragEvent.ACTION_DRAG_ENDED:
					wasShown = true;
					View view = (View) e.getLocalState();
					if (e.getResult()) {
						System.out.println("DROP SUCCESSFUL");
						colors.add(GetColorById(view.getId()));
						mClearButton.setEnabled(true);
					}
					else {
						System.out.println("DROP FAILED");
						view.setVisibility(View.VISIBLE);
					}
					return true;
				default:
					System.out.println("BROKEN");
					break;
			}
		}
		return false;
	}

	@SuppressLint("NonConstantResourceId")
	public String GetColorById(int id) {
		int stringId;
		switch(id) {
			case R.id.circleRed:
				stringId = R.string.Red;
				break;
			case R.id.circleOrange:
				stringId = R.string.Orange;
				break;
			case R.id.circleYellow:
				stringId = R.string.Yellow;
				break;
			case R.id.circleGreen:
				stringId = R.string.Green;
				break;
			case R.id.circleBluPur:
				stringId = R.string.BluePurple;
				break;
			case R.id.circleBrown:
				stringId = R.string.Brown;
				break;
			default:
				System.out.println("SELECTING COLOR IS BROKEN");
				stringId = -1;
				break;
		}
		return getResources().getString(stringId);
	}
}