# yii2-ironmq
A Yii2 extension for IronMQ V3

This is an extension for Yii2 that makes it easy to use IronMq V3.


Add it to the composer file

	"require": {
        "php": ">=5.4.0",
        "yiisoft/yii2": "*",
        "yiisoft/yii2-bootstrap": "*",
        "yiisoft/yii2-swiftmailer": "*",
	  	"br0sk/yii2-ironmq": "0.*",
    },

You can configure it in your application `components` configuration like so:

    'ironmq' => [
		//Mandatory config values
        'class' => 'br0sk\ironmq\IronMQ',
        'projectId' 	=> 'yourprojectid',
        'token' 		=> 'yourtoken'
		//Optional config values
		'protocol'  	=> 'https',
        'host'      	=> 'mq-aws-us-east-1-1.iron.io',
        'port'      	=> '443',
        'api_version' 	=> '3'
    ],
	

**note:** You can find the project id and token in the HUD for your V3 queue if you log in [here](https://hud-e.iron.io/). 
The tokens can be found on their own page here [here](https://hud.iron.io/tokens).

An example of typical usage:

		//Push a message to the queue
		$pushedMessage = Yii::$app->ironmq->postMessage("queue_name", "Test Message");
		//Reserve a message from the queue to process it
		$message = Yii::$app->ironmq->reserveMessage('queue_name')
		//When processing is done remove the message from the queue
		$deltedResult = Yii::$app->ironmq->deleteMessage('vehicle_data', $message->id, $message->reservation_id);

		
    
You can now use all the calls in the [IronMQ API](http://dev.iron.io/mq/3/reference/api/). 

This extension is a wrapper for [irom_mq_php](https://github.com/iron-io/iron_mq_php/tree/v4)

