import paho.mqtt.client as mqtt
import re

MQTT_HOST = "vsi_mqtt_broker"
MQTT_PORT = 1883
MQTT_TOPIC = "WildAI/#"
S3_MOUNT = "/mnt/wildtrack-ai/new-files/"
QOS = 2

# create mqtt on_connect callback
def on_connect(client, userdata, flags, rc):
    print("\nConnected to Cloud Broker with RC: " + str(rc))
    client.subscribe(MQTT_TOPIC, QOS)

# create mqtt on_subscribe callback
def on_subscribe(client, userdata, msgid, qos):
    print("Subscribed to Topic", MQTT_TOPIC, "with Granted QOS", qos)
    print("Waiting for Messages...\n")
                          
# create mqtt on_message callback
def on_message(client, userdata, msg):
    print("Message Received with QOS", msg.qos, "on Topic:", msg.topic)

    # parse file attributes from message topic; create file name
    fileAtt = msg.topic[len(MQTT_TOPIC)-1:]
    fileName = re.sub('/','_',fileAtt)+'.png'

    # save image to s3 mounted drive
    path = S3_MOUNT+fileName
    imgFile = open(path, 'wb')
    imgFile.write(msg.payload)
    imgFile.close()
    print("Image saved to", S3_MOUNT, "as", fileName+"\n")

# create mqtt client; initiate callback functions; connect to mqtt host
mqttclient = mqtt.Client("Cloud Subscriber")
mqttclient.on_connect = on_connect
mqttclient.on_subscribe = on_subscribe
mqttclient.on_message = on_message
mqttclient.connect(MQTT_HOST, MQTT_PORT, 600)

mqttclient.loop_forever()

