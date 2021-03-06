package health.tropikl;

import androidx.appcompat.app.AlertDialog;
import androidx.appcompat.app.AppCompatActivity;
import androidx.core.view.ViewCompat;

import android.annotation.SuppressLint;
import android.content.Intent;
import android.os.Bundle;
import android.os.Handler;
import android.view.Window;
import android.view.WindowManager;
import android.view.animation.DecelerateInterpolator;
import android.webkit.JavascriptInterface;
import android.webkit.WebResourceRequest;
import android.webkit.WebSettings;
import android.webkit.WebView;
import android.webkit.WebViewClient;
import android.widget.Button;

import java.util.Objects;

public class MainActivity extends AppCompatActivity
{
	final String WEBSITE_URL = "https://tropikl.health/";
	final static String IDIntent = "ID INTENT";
	static int idValue = -1;
	WebView myWebView;
	final private Handler mHandler = new Handler();
	Button mFeedFishButton;

	@SuppressLint("SetJavaScriptEnabled")
	@Override
	protected void onCreate(Bundle savedInstanceState)
	{
		super.onCreate(savedInstanceState);
		requestWindowFeature(Window.FEATURE_NO_TITLE);
		this.getWindow().setFlags(WindowManager.LayoutParams.FLAG_FULLSCREEN, WindowManager.LayoutParams.FLAG_FULLSCREEN);
		Objects.requireNonNull(getSupportActionBar()).hide();
		setContentView(R.layout.activity_main);

		mFeedFishButton = findViewById(R.id.feedFishButton);
		mFeedFishButton.setOnClickListener(view -> {
			Intent intent = new Intent(getApplicationContext(), FeedFishActivity.class);
			System.out.println("Adding intent id: " + idValue);
			intent.putExtra(IDIntent, idValue);
			startActivity(intent);
		});

		myWebView = findViewById(R.id.webView);
		myWebView.setWebViewClient(new WebViewClient() {
			public boolean shouldOverrideUrlLoading(WebView view, WebResourceRequest request){
				return true;
			}
		});
		myWebView.loadUrl(WEBSITE_URL);
		myWebView.reload();
		WebSettings webSettings = myWebView.getSettings();
		webSettings.setJavaScriptEnabled(true);
		myWebView.addJavascriptInterface(new MainActivity(), "IDInterface");
		myWebView.clearCache(true);

		handleButton();
	}

	private void handleButton() {
		mFeedFishButton.setAlpha(0);
		ViewCompat.animate(mFeedFishButton).setStartDelay(3500).alpha(1).setDuration(700)
				.setInterpolator(new DecelerateInterpolator(1.2f)).start();
	}

	@Override
	protected void onResume() {
		super.onResume();
		myWebView.clearCache(true);
		mHandler.postDelayed(() -> myWebView.reload(), 1000);
		handleButton();
	}

	@Override
	public void onBackPressed() {
		new AlertDialog.Builder(this)
				.setIcon(android.R.drawable.ic_dialog_alert)
				.setTitle("Closing Activity")
				.setMessage("Are you sure you want to close this activity?")
				.setPositiveButton("Yes", (dialog, which) -> finish())
				.setNegativeButton("No", null)
				.show();
	}

	// This function is for the PHP to pass the user_id back to the app
	@JavascriptInterface
	public void setId(int id) {
		// do something with the id
		idValue = id;
		System.out.println("Received id: " + idValue);
	}
}