import paho.mqtt.client as mqtt

LOCAL_MQTT_HOST = "mqttBrok"
CLOUD_MQTT_HOST = "159.8.123.44"
MQTT_PORT = 1883 #same for local and cloud
MQTT_TOPIC = "WildAI/#" #same for local and cloud
QOS = 2


def on_connect_local(client, userdata, flags, rc):
    print("\nConnected to Edge Broker with RC:", rc)
    client.subscribe(MQTT_TOPIC, QOS)

def on_subscribe(client, userdata, msgid, qos):
    print("Subscribed to Topic", MQTT_TOPIC, "with Granted QOS:", qos)
    print("Waiting to Receive Messages...\n")

def on_connect_cloud(client, userdata, flags, rc):
    print("Connected to Cloud Broker with RC:", rc)
    print("Waiting to Publish Messages...\n") 

def on_message(client, userdata, msg):
    print("Message Received with QOS", msg.qos, "on Topic:", msg.topic)
    print("Publishing Message to Cloud Broker with QOS:", QOS)
    cloudmqttclient.publish(msg.topic, payload=msg.payload, qos=QOS, retain=False)

def on_publish(client, userdata, msgid):
    print("Message", msgid, "Published to Cloud Broker\n")

def on_disconnect_local(client, userdata, rc):
    client.loop_stop()

localmqttclient = mqtt.Client("Edge Subscriber")
cloudmqttclient = mqtt.Client("Edge to Cloud Forwarder")

localmqttclient.on_connect = on_connect_local
localmqttclient.on_subscribe = on_subscribe
cloudmqttclient.on_connect = on_connect_cloud

localmqttclient.on_message = on_message
cloudmqttclient.on_publish = on_publish
localmqttclient.on_disconnect = on_disconnect_local

localmqttclient.connect(LOCAL_MQTT_HOST, MQTT_PORT, 600)
localmqttclient.loop_start()
cloudmqttclient.connect(CLOUD_MQTT_HOST, MQTT_PORT, 600)

cloudmqttclient.loop_forever()  
