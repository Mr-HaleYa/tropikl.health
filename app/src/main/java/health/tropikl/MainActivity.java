package health.tropikl;

import androidx.appcompat.app.AppCompatActivity;

import android.annotation.SuppressLint;
import android.content.Intent;
import android.os.Bundle;
import android.os.Handler;
import android.view.Window;
import android.view.WindowManager;
import android.webkit.JavascriptInterface;
import android.webkit.WebSettings;
import android.webkit.WebView;
import android.webkit.WebViewClient;
import android.webkit.WebViewDatabase;
import android.widget.Button;

import java.util.Objects;

public class MainActivity extends AppCompatActivity
{
	final String WEBSITE_URL = "https://tropikl.health/";
	final static String IDIntent = "ID INTENT";
	static int idValue;
	WebView myWebView;
	private Handler mHandler = new Handler();

	@SuppressLint("SetJavaScriptEnabled")
	@Override
	protected void onCreate(Bundle savedInstanceState)
	{
		super.onCreate(savedInstanceState);
		requestWindowFeature(Window.FEATURE_NO_TITLE);
		this.getWindow().setFlags(WindowManager.LayoutParams.FLAG_FULLSCREEN, WindowManager.LayoutParams.FLAG_FULLSCREEN);
		Objects.requireNonNull(getSupportActionBar()).hide();
		setContentView(R.layout.activity_main);
		myWebView = findViewById(R.id.webView);
		myWebView.setWebViewClient(new WebViewClient() {
			public boolean shouldOverrideUrlLoading(WebView view, String url){
				// do your handling codes here, which url is the requested url
				// probably you need to open that url rather than redirect:
				view.loadUrl(url);
				return false; // then it is not handled by default action
			}
		});
		myWebView.loadUrl(WEBSITE_URL);
		myWebView.reload();
		WebSettings webSettings = myWebView.getSettings();
		webSettings.setJavaScriptEnabled(true);
		myWebView.addJavascriptInterface(new MainActivity(), "IDInterface");
		myWebView.clearCache(true);

		final Button mFeedFishButton = findViewById(R.id.feedFishButton);
		mFeedFishButton.setOnClickListener(view -> {
			Intent intent = new Intent(getApplicationContext(), FeedFishActivity.class);
			System.out.println("Adding intent id: " + idValue);
			intent.putExtra(IDIntent, idValue);
			startActivity(intent);
		});
		WebViewDatabase myWebViewDB = WebViewDatabase.getInstance(getApplicationContext());
		boolean hasAuth = myWebViewDB.hasFormData();
		System.out.println("Has Form Data? " + hasAuth);
	}

	@Override
	protected void onResume() {
		super.onResume();
		mHandler.postDelayed(() -> myWebView.reload(), 1000);
	}

	@JavascriptInterface
	public void setId(int id) {
		// do something with the id
		idValue = id;
		System.out.println("Received id: " + idValue);
	}
}