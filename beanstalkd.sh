daemon=beanstalkd
executable=/usr/local/bin/$daemon
port=11300
waldir=/usr/local/var/beanstalkd
logfile=/usr/local/var/log/beanstalkd.log
interface="127.0.0.1"
params="$port -b $waldir"

if [ -d $waldir ]; then true ; else mkdir -p $waldir || echo "ERROR: can't create $waldir"; fi

if [ -d $waldir ]; then true ; else echo "ERROR: $waldir does not exist"; fi

case "$1" in
start)
   $executable $params >> $logfile 2>&1 &
   [ $? -eq 0 ] && echo "$daemon started..."
;;
stop)
   killall $daemon
   [ $? -eq 0 ] && echo "$daemon stopped..."
;;
restart)
   $0 stop
   $0 start
;;
*)
   echo "Usage: $0 (start|stop|restart)"
;;
esac

