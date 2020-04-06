import paho.mqtt.client as mqtt

MQTT_TOPIC = "WildAI/TX2-JDS/#"
QOS = 1

LOCAL_MQTT_HOST = "mqttBrok"
LOCAL_MQTT_PORT = 1883

CLOUD_MQTT_HOST = "159.8.123.44"
CLOUD_MQTT_PORT = 1883

def on_connect_local(client, userdata, flags, rc):
    print("Connected to Edge Broker with RC:", rc)
    client.subscribe(MQTT_TOPIC)
    print("Subscribed to Topic:", MQTT_TOPIC)
    print("Waiting for Messages...")

def on_connect_cloud(client, userdata, flags, rc):
    print("Connected to Cloud Broker")
#    client.subscribe(CLOUD_MQTT_TOPIC)

def on_message(client, userdata, msg):
    print("Message Received on Topic:", msg.topic)
    print("Publishing to Cloud")
    cloudmqttclient.publish(msg.topic, payload=msg.payload, qos=QOS, retain=False)
#    print(msg.payload)

localmqttclient = mqtt.Client("Edge Subscriber")
localmqttclient.on_connect = on_connect_local
localmqttclient.connect(LOCAL_MQTT_HOST, LOCAL_MQTT_PORT, 600)
localmqttclient.on_message = on_message

cloudmqttclient = mqtt.Client("Edge to Cloud Forwarder")
cloudmqttclient.on_connect = on_connect_cloud
cloudmqttclient.connect(CLOUD_MQTT_HOST, CLOUD_MQTT_PORT, 600)

localmqttclient.loop_forever()
cloudmqttclient.loop_forever()
