# docker build -t vsi_mqtt_broker .
# docker run --name vsi_mqtt_broker --network cloud-wildtrack-ai -p 1883:1883 vsi_mqtt_broker

FROM alpine

RUN apk update
RUN apk add mosquitto

CMD /usr/sbin/mosquitto
