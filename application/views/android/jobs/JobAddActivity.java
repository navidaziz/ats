
public class JobAddActivity extends AppCompatActivity {
	
	private EditText job_source_id;
				private text job_title;
				private text job_detail;
				private text job_end_date;
				private EditText job_image;
				private text job_summary;
				private Button btn_add_jobs;
	
	@Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        this.requestWindowFeature(Window.FEATURE_NO_TITLE);
        setContentView(R.layout.activity_add_job);
		
		job_source_id = (EditText)findViewById(R.id.job_source_id);
				job_title = (text)findViewById(R.id.job_title);
				job_detail = (text)findViewById(R.id.job_detail);
				job_end_date = (text)findViewById(R.id.job_end_date);
				job_image = (EditText)findViewById(R.id.job_image);
				job_summary = (text)findViewById(R.id.job_summary);
				btn_add_jobs = (Button)findViewById(R.id.btn_add_jobs);
		
		
btn_add_jobs.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                //do your code here
				final String form_job_source_id = job_source_id.getText().toString();
				final String form_job_title = job_title.getText().toString();
				final String form_job_detail = job_detail.getText().toString();
				final String form_job_end_date = job_end_date.getText().toString();
				final String form_job_image = job_image.getText().toString();
				final String form_job_summary = job_summary.getText().toString();
				
				
				RequestQueue request_queue = Volley.newRequestQueue(JobAddActivity.this); 
				 StringRequest request = new StringRequest(Request.Method.POST, SERVER_URL+"/mobile/job/save_data", new Response.Listener<String>() {
								@Override
								public void onResponse(String server_response) {
								Toast.makeText(JobAddActivity.this, server_response, Toast.LENGTH_SHORT).show();
								}
							}, new Response.ErrorListener() {
								@Override
								public void onErrorResponse(VolleyError volleyError) {
								Toast.makeText(JobAddActivity.this, volleyError.toString(), Toast.LENGTH_SHORT).show();
								}
							}){
								@Override
								protected Map<String, String> getParams()  {
									HashMap<String,String> params = new HashMap<String,String>();
									params.put("job_source_id", form_job_source_id);
				params.put("job_title", form_job_title);
				params.put("job_detail", form_job_detail);
				params.put("job_end_date", form_job_end_date);
				params.put("job_image", form_job_image);
				params.put("job_summary", form_job_summary);
				
									return params;
								}
							};
							
				 request_queue.add(request);
				
				
            }
        });
//end here .....
		
		

     }

}
