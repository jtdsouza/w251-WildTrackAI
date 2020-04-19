import paho.mqtt.client as mqtt

# insert name of edge device
device = 'TX2-MAR'

LOCAL_MQTT_HOST = "edge_mqtt_broker"
CLOUD_MQTT_HOST = "159.8.123.44"
MQTT_PORT = 1883 #same for local and cloud
MQTT_TOPIC = "WildAI/#" #same for local and cloud
QOS = 2

# create on_connect callback for local/edge mqtt client
def on_connect_local(client, userdata, flags, rc):
    print("\nConnected to Edge Broker with RC:", rc)
    client.subscribe(MQTT_TOPIC, QOS)

# create on_subscribe callback for local/edge mqtt client
def on_subscribe(client, userdata, msgid, qos):
    print("Subscribed to Topic", MQTT_TOPIC, "with Granted QOS:", qos)
    print("Waiting to Receive Messages...\n")

# create on_connect callback for cloud mqtt client
def on_connect_cloud(client, userdata, flags, rc):
    print("Connected to Cloud Broker with RC:", rc)
    print("Waiting to Publish Messages...\n") 

# create on_message callback for local/edge mqtt client
def on_message(client, userdata, msg):
    print("Message Received with QOS", msg.qos, "on Topic:", msg.topic)
    print("Publishing Message to Cloud Broker with QOS:", QOS)
    # publish message to cloud
    cloudmqttclient.publish(msg.topic, payload=msg.payload, qos=QOS, retain=False)

# create on_publish callback for cloud mqtt client
def on_publish(client, userdata, msgid):
    print("Message", msgid, "Published to Cloud Broker\n")

def on_disconnect_local(client, userdata, rc):
    client.loop_stop()

# create local/edge and cloud mqtt clients
localmqttclient = mqtt.Client("Edge Subscriber")
cloudmqttclient = mqtt.Client("Edge to Cloud Forwarder: " + device)

# initialize callback functions
localmqttclient.on_connect = on_connect_local
localmqttclient.on_subscribe = on_subscribe
cloudmqttclient.on_connect = on_connect_cloud

localmqttclient.on_message = on_message
cloudmqttclient.on_publish = on_publish
localmqttclient.on_disconnect = on_disconnect_local

# connect local/edge and cloud mqtt clients
localmqttclient.connect(LOCAL_MQTT_HOST, MQTT_PORT, 600)
localmqttclient.loop_start()
cloudmqttclient.connect(CLOUD_MQTT_HOST, MQTT_PORT, 600)

cloudmqttclient.loop_forever()  
