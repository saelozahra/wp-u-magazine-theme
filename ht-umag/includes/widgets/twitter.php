<?php
/**
 * HighThemes Recent Tweets
 */

class ht_twitter extends WP_Widget {

	public function __construct() {
		global $theme_name;
		$widget_ops = array(
			'classname'   => 'ht_twitter',
			'description' => __( 'Recent tweets', 'highthemes' ),
			'panels_groups' => array( 'highthemes' )

		);
		parent::__construct(
			'ht_twitter',
			'Highthemes - ' . __( 'Recent Tweets', 'highthemes' ),
			$widget_ops // Args
		);
	}


		public function widget($args, $instance) {
			extract($args);

			echo $before_widget;				

			
				//check settings and die if not set
					if(empty($instance['consumerkey']) || empty($instance['consumersecret']) || empty($instance['accesstoken']) || empty($instance['accesstokensecret']) || empty($instance['cachetime']) || empty($instance['username'])){
						echo __('<strong>Please fill all widget settings!</strong>','highthemes') . $after_widget;
						return;
					}
				
									
				//check if cache needs update
					$tp_twitter_plugin_last_cache_time = get_option('tp_twitter_plugin_last_cache_time');
					$diff = time() - $tp_twitter_plugin_last_cache_time;
					$crt = $instance['cachetime'] * 3600;
					
				 //	yes, it needs update			
					if($diff >= $crt || empty($tp_twitter_plugin_last_cache_time)){
						
						if(!require_once(HT_THEME_INC_DIR .'lib/twitteroauth.php')){ 
							echo __('<strong>Couldn\'t find twitteroauth.php!</strong>','highthemes') . $after_widget;
							return;
						}
													
						function getConnectionWithAccessToken($cons_key, $cons_secret, $oauth_token, $oauth_token_secret) {
						  $connection = new TwitterOAuth($cons_key, $cons_secret, $oauth_token, $oauth_token_secret);
						  return $connection;
						}
						  
						  							  
						$connection = getConnectionWithAccessToken($instance['consumerkey'], $instance['consumersecret'], $instance['accesstoken'], $instance['accesstokensecret']);
						$tweets = $connection->get("https://api.twitter.com/1.1/statuses/user_timeline.json?screen_name=".$instance['username']."&count=10&exclude_replies=".$instance['excludereplies']) or die('Couldn\'t retrieve tweets! Wrong username?');
						
													
						if(!empty($tweets->errors)){
							if($tweets->errors[0]->message == 'Invalid or expired token'){
								echo '<strong>'.$tweets->errors[0]->message.'!</strong><br />'.__('You\'ll need to regenerate it <a href="https://dev.twitter.com/apps" target="_blank">here</a>!','highthemes') . $after_widget;
							}else{
								echo '<strong>'.$tweets->errors[0]->message.'</strong>' . $after_widget;
							}
							return;
						}
						
						for($i = 0;$i <= count($tweets); $i++){
							if(!empty($tweets[$i])){
								$tweets_array[$i]['created_at'] = $tweets[$i]->created_at;
								$tweets_array[$i]['text'] = $tweets[$i]->text;			
								$tweets_array[$i]['status_id'] = $tweets[$i]->id_str;			
							}	
						}							
						
						//save tweets to wp option 		
							update_option('tp_twitter_plugin_tweets',serialize($tweets_array));							
							update_option('tp_twitter_plugin_last_cache_time',time());
							
						echo '<!-- twitter cache has been updated! -->';
					}
					
					
											

				$tp_twitter_plugin_tweets = maybe_unserialize(get_option('tp_twitter_plugin_tweets'));
				if(!empty($tp_twitter_plugin_tweets)){
				?>
					<!-- LIVE TWEETS STARTS -->
					<div class="tweets" id="tweets_<?php echo esc_attr($args['widget_id']); ?>">
						<h3>Live Tweets</h3>
						<ul>
						<?php
						$fctr = '1';
						foreach($tp_twitter_plugin_tweets as $tweet):

							echo '<li class="item clearfix">
											'.ht_tp_convert_links($tweet['text']).'
									</li>';

							if( $fctr == $instance['tweetstoshow'] ){ break; }
							$fctr++;

						endforeach;
						?>
						</ul>
					</div>
					<!-- LIVE TWEETS ENDS -->
				<?php
				}
			
			
			
			echo $after_widget;
		}
		

	//save widget settings 
		public function update($new_instance, $old_instance) {				
			$instance = array();
			$instance['consumerkey'] = strip_tags( $new_instance['consumerkey'] );
			$instance['consumersecret'] = strip_tags( $new_instance['consumersecret'] );
			$instance['accesstoken'] = strip_tags( $new_instance['accesstoken'] );
			$instance['accesstokensecret'] = strip_tags( $new_instance['accesstokensecret'] );
			$instance['cachetime'] = strip_tags( $new_instance['cachetime'] );
			$instance['username'] = strip_tags( $new_instance['username'] );
			$instance['tweetstoshow'] = strip_tags( $new_instance['tweetstoshow'] );
			$instance['excludereplies'] = strip_tags( $new_instance['excludereplies'] );

			if($old_instance['username'] != $new_instance['username']){
				delete_option('tp_twitter_plugin_last_cache_time');
			}
			
			return $instance;
		}
		
		
	//widget settings form	
		public function form($instance) {
			$defaults = array( 'title' => '', 'consumerkey' => '', 'consumersecret' => '', 'accesstoken' => '', 'accesstokensecret' => '', 'cachetime' => '', 'username' => '', 'tweetstoshow' => '' );
			$instance = wp_parse_args( (array) $instance, $defaults );
					
			echo '
			<p><label>'.__('Consumer Key','highthemes').':</label>
				<input type="text" name="'.$this->get_field_name( 'consumerkey' ).'" id="'.$this->get_field_id( 'consumerkey' ).'" value="'.esc_attr($instance['consumerkey']).'" class="widefat" /></p>
			<p><label>'.__('Consumer Secret','highthemes').':</label>
				<input type="text" name="'.$this->get_field_name( 'consumersecret' ).'" id="'.$this->get_field_id( 'consumersecret' ).'" value="'.esc_attr($instance['consumersecret']).'" class="widefat" /></p>					
			<p><label>'.__('Access Token','highthemes').':</label>
				<input type="text" name="'.$this->get_field_name( 'accesstoken' ).'" id="'.$this->get_field_id( 'accesstoken' ).'" value="'.esc_attr($instance['accesstoken']).'" class="widefat" /></p>									
			<p><label>'.__('Access Token Secret','highthemes').':</label>
				<input type="text" name="'.$this->get_field_name( 'accesstokensecret' ).'" id="'.$this->get_field_id( 'accesstokensecret' ).'" value="'.esc_attr($instance['accesstokensecret']).'" class="widefat" /></p>														
			<p><label>'.__('Cache Tweets in every','highthemes').':</label>
				<input type="text" name="'.$this->get_field_name( 'cachetime' ).'" id="'.$this->get_field_id( 'cachetime' ).'" value="'.esc_attr($instance['cachetime']).'" class="small-text" /> hours</p>																			
			<p><label>'.__('Twitter Username','highthemes').':</label>
				<input type="text" name="'.$this->get_field_name( 'username' ).'" id="'.$this->get_field_id( 'username' ).'" value="'.esc_attr($instance['username']).'" class="widefat" /></p>																			
			<p><label>'.__('Tweets to display','highthemes').':</label>
				<select type="text" name="'.$this->get_field_name( 'tweetstoshow' ).'" id="'.$this->get_field_id( 'tweetstoshow' ).'">';
				$i = 1;
				for($i; $i <= 10; $i++){
					echo '<option value="'.$i.'"'; if($instance['tweetstoshow'] == $i){ echo ' selected="selected"'; } echo '>'.$i.'</option>';						
				}
				echo '
				</select></p>
			<p>
				<input type="checkbox" name="'.$this->get_field_name( 'excludereplies' ).'" id="'.$this->get_field_id( 'excludereplies' ).'" value="true"';
				if(!empty($instance['excludereplies']) && esc_attr($instance['excludereplies']) == 'true'){
					print ' checked="checked"';
				}					
				print ' /><label>'.__('Exclude replies','highthemes').'</label></p>';
		}
	}




									
				
	
