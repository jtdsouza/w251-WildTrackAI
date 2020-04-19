# docker build -t edge_mqtt_broker .
# docker run --name edge_mqtt_broker --network footprints -p 1883:1883 edge_mqtt_broker

FROM alpine

RUN apk update
RUN apk add mosquitto

CMD /usr/sbin/mosquitto
