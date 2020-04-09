import paho.mqtt.client as mqtt

MQTT_TOPIC = "WildAI/TX2-JDS/#"
QOS = 0

LOCAL_MQTT_HOST = "mqttBrok"
LOCAL_MQTT_PORT = 1883

CLOUD_MQTT_HOST = "159.8.123.44"
CLOUD_MQTT_PORT = 1883

def on_connect_local(client, userdata, flags, rc):
    print("\nConnected to Edge Broker with RC:", rc)
    client.subscribe(MQTT_TOPIC)
    print("Subscribed to Topic:", MQTT_TOPIC)
    print("Waiting for Messages...\n")

def on_connect_cloud(client, userdata, flags, rc):
    print("Connected to Cloud Broker")

def on_message(client, userdata, msg):
    print("\nMessage Received on Topic:", msg.topic)
    print("Publishing Message to Cloud with QOS:", QOS)
    cloudmqttclient.publish(msg.topic, payload=msg.payload, qos=QOS, retain=False)

def on_publish_cloud(client, userdata, result):
    print("Message Published to Cloud:", result)
    print("")

localmqttclient = mqtt.Client("Edge Subscriber")
cloudmqttclient = mqtt.Client("Edge to Cloud Forwarder")

localmqttclient.on_connect = on_connect_local
cloudmqttclient.on_connect = on_connect_cloud

localmqttclient.on_message = on_message
cloudmqttclient.on_publish = on_publish_cloud

localmqttclient.connect(LOCAL_MQTT_HOST, LOCAL_MQTT_PORT, 600)
cloudmqttclient.connect(CLOUD_MQTT_HOST, CLOUD_MQTT_PORT, 600)

localmqttclient.loop_forever()
cloudmqttclient.loop_forever()
