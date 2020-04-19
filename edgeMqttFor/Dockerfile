# docker build -t edge_mqtt_forwarder .
# docker run --rm --name edge_mqtt_forwarder --network footprints -v /mnt/w251/WildAI/mqttLocFor:/app -w /app edge_mqtt_forwarder

FROM alpine

RUN apk update
RUN apk add mosquitto-clients
RUN apk add py3-paho-mqtt

#ENTRYPOINT ["python3"]
#CMD ["run.py"]
