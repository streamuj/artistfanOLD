<?php


/**
 * Base class that represents a query for the 'chat' table.
 *
 * 
 *
 * @method     ChatQuery orderByChtId($order = Criteria::ASC) Order by the cht_id column
 * @method     ChatQuery orderByChtFrom($order = Criteria::ASC) Order by the cht_from column
 * @method     ChatQuery orderByChtTo($order = Criteria::ASC) Order by the cht_to column
 * @method     ChatQuery orderByChtMessage($order = Criteria::ASC) Order by the cht_message column
 * @method     ChatQuery orderByChtSent($order = Criteria::ASC) Order by the cht_sent column
 * @method     ChatQuery orderByChtRecd($order = Criteria::ASC) Order by the cht_recd column
 *
 * @method     ChatQuery groupByChtId() Group by the cht_id column
 * @method     ChatQuery groupByChtFrom() Group by the cht_from column
 * @method     ChatQuery groupByChtTo() Group by the cht_to column
 * @method     ChatQuery groupByChtMessage() Group by the cht_message column
 * @method     ChatQuery groupByChtSent() Group by the cht_sent column
 * @method     ChatQuery groupByChtRecd() Group by the cht_recd column
 *
 * @method     ChatQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChatQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChatQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     Chat findOne(PropelPDO $con = null) Return the first Chat matching the query
 * @method     Chat findOneOrCreate(PropelPDO $con = null) Return the first Chat matching the query, or a new Chat object populated from the query conditions when no match is found
 *
 * @method     Chat findOneByChtId(int $cht_id) Return the first Chat filtered by the cht_id column
 * @method     Chat findOneByChtFrom(int $cht_from) Return the first Chat filtered by the cht_from column
 * @method     Chat findOneByChtTo(int $cht_to) Return the first Chat filtered by the cht_to column
 * @method     Chat findOneByChtMessage(string $cht_message) Return the first Chat filtered by the cht_message column
 * @method     Chat findOneByChtSent(int $cht_sent) Return the first Chat filtered by the cht_sent column
 * @method     Chat findOneByChtRecd(int $cht_recd) Return the first Chat filtered by the cht_recd column
 *
 * @method     array findByChtId(int $cht_id) Return Chat objects filtered by the cht_id column
 * @method     array findByChtFrom(int $cht_from) Return Chat objects filtered by the cht_from column
 * @method     array findByChtTo(int $cht_to) Return Chat objects filtered by the cht_to column
 * @method     array findByChtMessage(string $cht_message) Return Chat objects filtered by the cht_message column
 * @method     array findByChtSent(int $cht_sent) Return Chat objects filtered by the cht_sent column
 * @method     array findByChtRecd(int $cht_recd) Return Chat objects filtered by the cht_recd column
 *
 * @package    propel.generator.artistfan.om
 */
abstract class BaseChatQuery extends ModelCriteria
{
	
	/**
	 * Initializes internal state of BaseChatQuery object.
	 *
	 * @param     string $dbName The dabase name
	 * @param     string $modelName The phpName of a model, e.g. 'Book'
	 * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
	 */
	public function __construct($dbName = 'artistfan', $modelName = 'Chat', $modelAlias = null)
	{
		parent::__construct($dbName, $modelName, $modelAlias);
	}

	/**
	 * Returns a new ChatQuery object.
	 *
	 * @param     string $modelAlias The alias of a model in the query
	 * @param     Criteria $criteria Optional Criteria to build the query from
	 *
	 * @return    ChatQuery
	 */
	public static function create($modelAlias = null, $criteria = null)
	{
		if ($criteria instanceof ChatQuery) {
			return $criteria;
		}
		$query = new ChatQuery();
		if (null !== $modelAlias) {
			$query->setModelAlias($modelAlias);
		}
		if ($criteria instanceof Criteria) {
			$query->mergeWith($criteria);
		}
		return $query;
	}

	/**
	 * Find object by primary key.
	 * Propel uses the instance pool to skip the database if the object exists.
	 * Go fast if the query is untouched.
	 *
	 * <code>
	 * $obj  = $c->findPk(12, $con);
	 * </code>
	 *
	 * @param     mixed $key Primary key to use for the query
	 * @param     PropelPDO $con an optional connection object
	 *
	 * @return    Chat|array|mixed the result, formatted by the current formatter
	 */
	public function findPk($key, $con = null)
	{
		if ($key === null) {
			return null;
		}
		if ((null !== ($obj = ChatPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
			// the object is alredy in the instance pool
			return $obj;
		}
		if ($con === null) {
			$con = Propel::getConnection(ChatPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}
		$this->basePreSelect($con);
		if ($this->formatter || $this->modelAlias || $this->with || $this->select
		 || $this->selectColumns || $this->asColumns || $this->selectModifiers
		 || $this->map || $this->having || $this->joins) {
			return $this->findPkComplex($key, $con);
		} else {
			return $this->findPkSimple($key, $con);
		}
	}

	/**
	 * Find object by primary key using raw SQL to go fast.
	 * Bypass doSelect() and the object formatter by using generated code.
	 *
	 * @param     mixed $key Primary key to use for the query
	 * @param     PropelPDO $con A connection object
	 *
	 * @return    Chat A model object, or null if the key is not found
	 */
	protected function findPkSimple($key, $con)
	{
		$sql = 'SELECT `CHT_ID`, `CHT_FROM`, `CHT_TO`, `CHT_MESSAGE`, `CHT_SENT`, `CHT_RECD` FROM `chat` WHERE `CHT_ID` = :p0';
		try {
			$stmt = $con->prepare($sql);
			$stmt->bindValue(':p0', $key, PDO::PARAM_INT);
			$stmt->execute();
		} catch (Exception $e) {
			Propel::log($e->getMessage(), Propel::LOG_ERR);
			throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), $e);
		}
		$obj = null;
		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$obj = new Chat();
			$obj->hydrate($row);
			ChatPeer::addInstanceToPool($obj, (string) $row[0]);
		}
		$stmt->closeCursor();

		return $obj;
	}

	/**
	 * Find object by primary key.
	 *
	 * @param     mixed $key Primary key to use for the query
	 * @param     PropelPDO $con A connection object
	 *
	 * @return    Chat|array|mixed the result, formatted by the current formatter
	 */
	protected function findPkComplex($key, $con)
	{
		// As the query uses a PK condition, no limit(1) is necessary.
		$criteria = $this->isKeepQuery() ? clone $this : $this;
		$stmt = $criteria
			->filterByPrimaryKey($key)
			->doSelect($con);
		return $criteria->getFormatter()->init($criteria)->formatOne($stmt);
	}

	/**
	 * Find objects by primary key
	 * <code>
	 * $objs = $c->findPks(array(12, 56, 832), $con);
	 * </code>
	 * @param     array $keys Primary keys to use for the query
	 * @param     PropelPDO $con an optional connection object
	 *
	 * @return    PropelObjectCollection|array|mixed the list of results, formatted by the current formatter
	 */
	public function findPks($keys, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection($this->getDbName(), Propel::CONNECTION_READ);
		}
		$this->basePreSelect($con);
		$criteria = $this->isKeepQuery() ? clone $this : $this;
		$stmt = $criteria
			->filterByPrimaryKeys($keys)
			->doSelect($con);
		return $criteria->getFormatter()->init($criteria)->format($stmt);
	}

	/**
	 * Filter the query by primary key
	 *
	 * @param     mixed $key Primary key to use for the query
	 *
	 * @return    ChatQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKey($key)
	{
		return $this->addUsingAlias(ChatPeer::CHT_ID, $key, Criteria::EQUAL);
	}

	/**
	 * Filter the query by a list of primary keys
	 *
	 * @param     array $keys The list of primary key to use for the query
	 *
	 * @return    ChatQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKeys($keys)
	{
		return $this->addUsingAlias(ChatPeer::CHT_ID, $keys, Criteria::IN);
	}

	/**
	 * Filter the query on the cht_id column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByChtId(1234); // WHERE cht_id = 1234
	 * $query->filterByChtId(array(12, 34)); // WHERE cht_id IN (12, 34)
	 * $query->filterByChtId(array('min' => 12)); // WHERE cht_id > 12
	 * </code>
	 *
	 * @param     mixed $chtId The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    ChatQuery The current query, for fluid interface
	 */
	public function filterByChtId($chtId = null, $comparison = null)
	{
		if (is_array($chtId) && null === $comparison) {
			$comparison = Criteria::IN;
		}
		return $this->addUsingAlias(ChatPeer::CHT_ID, $chtId, $comparison);
	}

	/**
	 * Filter the query on the cht_from column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByChtFrom(1234); // WHERE cht_from = 1234
	 * $query->filterByChtFrom(array(12, 34)); // WHERE cht_from IN (12, 34)
	 * $query->filterByChtFrom(array('min' => 12)); // WHERE cht_from > 12
	 * </code>
	 *
	 * @param     mixed $chtFrom The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    ChatQuery The current query, for fluid interface
	 */
	public function filterByChtFrom($chtFrom = null, $comparison = null)
	{
		if (is_array($chtFrom)) {
			$useMinMax = false;
			if (isset($chtFrom['min'])) {
				$this->addUsingAlias(ChatPeer::CHT_FROM, $chtFrom['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($chtFrom['max'])) {
				$this->addUsingAlias(ChatPeer::CHT_FROM, $chtFrom['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(ChatPeer::CHT_FROM, $chtFrom, $comparison);
	}

	/**
	 * Filter the query on the cht_to column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByChtTo(1234); // WHERE cht_to = 1234
	 * $query->filterByChtTo(array(12, 34)); // WHERE cht_to IN (12, 34)
	 * $query->filterByChtTo(array('min' => 12)); // WHERE cht_to > 12
	 * </code>
	 *
	 * @param     mixed $chtTo The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    ChatQuery The current query, for fluid interface
	 */
	public function filterByChtTo($chtTo = null, $comparison = null)
	{
		if (is_array($chtTo)) {
			$useMinMax = false;
			if (isset($chtTo['min'])) {
				$this->addUsingAlias(ChatPeer::CHT_TO, $chtTo['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($chtTo['max'])) {
				$this->addUsingAlias(ChatPeer::CHT_TO, $chtTo['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(ChatPeer::CHT_TO, $chtTo, $comparison);
	}

	/**
	 * Filter the query on the cht_message column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByChtMessage('fooValue');   // WHERE cht_message = 'fooValue'
	 * $query->filterByChtMessage('%fooValue%'); // WHERE cht_message LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $chtMessage The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    ChatQuery The current query, for fluid interface
	 */
	public function filterByChtMessage($chtMessage = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($chtMessage)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $chtMessage)) {
				$chtMessage = str_replace('*', '%', $chtMessage);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(ChatPeer::CHT_MESSAGE, $chtMessage, $comparison);
	}

	/**
	 * Filter the query on the cht_sent column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByChtSent(1234); // WHERE cht_sent = 1234
	 * $query->filterByChtSent(array(12, 34)); // WHERE cht_sent IN (12, 34)
	 * $query->filterByChtSent(array('min' => 12)); // WHERE cht_sent > 12
	 * </code>
	 *
	 * @param     mixed $chtSent The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    ChatQuery The current query, for fluid interface
	 */
	public function filterByChtSent($chtSent = null, $comparison = null)
	{
		if (is_array($chtSent)) {
			$useMinMax = false;
			if (isset($chtSent['min'])) {
				$this->addUsingAlias(ChatPeer::CHT_SENT, $chtSent['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($chtSent['max'])) {
				$this->addUsingAlias(ChatPeer::CHT_SENT, $chtSent['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(ChatPeer::CHT_SENT, $chtSent, $comparison);
	}

	/**
	 * Filter the query on the cht_recd column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByChtRecd(1234); // WHERE cht_recd = 1234
	 * $query->filterByChtRecd(array(12, 34)); // WHERE cht_recd IN (12, 34)
	 * $query->filterByChtRecd(array('min' => 12)); // WHERE cht_recd > 12
	 * </code>
	 *
	 * @param     mixed $chtRecd The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    ChatQuery The current query, for fluid interface
	 */
	public function filterByChtRecd($chtRecd = null, $comparison = null)
	{
		if (is_array($chtRecd)) {
			$useMinMax = false;
			if (isset($chtRecd['min'])) {
				$this->addUsingAlias(ChatPeer::CHT_RECD, $chtRecd['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($chtRecd['max'])) {
				$this->addUsingAlias(ChatPeer::CHT_RECD, $chtRecd['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(ChatPeer::CHT_RECD, $chtRecd, $comparison);
	}

	/**
	 * Exclude object from result
	 *
	 * @param     Chat $chat Object to remove from the list of results
	 *
	 * @return    ChatQuery The current query, for fluid interface
	 */
	public function prune($chat = null)
	{
		if ($chat) {
			$this->addUsingAlias(ChatPeer::CHT_ID, $chat->getChtId(), Criteria::NOT_EQUAL);
		}

		return $this;
	}

} // BaseChatQuery